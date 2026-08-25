# Reels — backend

Short vertical photo/video posts, Instagram Reels style. Media lives in
DigitalOcean Spaces; MySQL only stores the object keys.

## Setup, in order

**1. Run the migration** — safe to re-run:

```
mysql -u USER -p DATABASE < database_reels.sql
```

Creates `reel_table` and `reel_like_table`, and adds `settings_table.reelsautopublish`.

**2. Put your Spaces credentials in `app/config/parameters.yml`:**

```yaml
    spaces_key:      DO00XXXXXXXXXXXXXXXX
    spaces_secret:   your-secret
    spaces_region:   blr1
    spaces_bucket:   your-space-name
    spaces_endpoint: https://blr1.digitaloceanspaces.com
    spaces_cdn:      ''        # optional CDN hostname
```

Create the key at <https://cloud.digitalocean.com/account/api/spaces>. The secret
stays on the server — it is never in the database and never in the APK. If you
skip this step the site still boots; reels just report "storage not configured".

**3. CORS on the Space — optional.**

The admin *Add reel* page tries a direct browser upload first and falls back to
sending through the server if the browser is blocked, so the panel works either
way. The Android app never needs CORS: it uploads with OkHttp, and CORS is a
browser rule only.

Add the rule if you want the panel to upload large files, since the fallback
path is capped by PHP's `upload_max_filesize`.

Rule to add (Settings → CORS Configurations). The admin
"Add reel" page uploads from the browser, and a cross-origin PUT is blocked
without it:

| Origin | Methods | Allowed headers | Max age |
|---|---|---|---|
| `https://your-panel-domain` | GET, PUT | `*` | 3600 |

Two details decide whether it works, and a third decides whether you can tell:

* **No trailing slash on the Origin.** Browsers send `Origin: https://example.com`,
  never `https://example.com/`, and Spaces matches the string exactly. A trailing
  slash silently matches nothing.
* **Allowed headers must cover `content-type` and `x-amz-acl`**, because the
  presigned PUT carries both and neither is CORS-safelisted at these values.
  `*` is the easy answer.
* **Max age caches the answer.** `Access Control Max Age: 3600` tells the browser
  to remember the preflight result for an hour. After fixing a rule, a stale
  "no" can persist that long — test in a fresh incognito window, or tick
  *Disable cache* in DevTools, before concluding the rule is still wrong.

The Android app uses OkHttp, not a browser, so it is not affected by CORS.

**4. Clear the cache:** `rm -rf app/cache/prod/*`

## How an upload works

The file never passes through the PHP server, so `upload_max_filesize`,
`post_max_size` and the execution timeout are all irrelevant to video size.

1. Client asks for a slot → gets a presigned `PUT` URL valid for 15 minutes,
   plus the exact headers it must send and the `object_key`.
2. Client `PUT`s the bytes straight to Spaces.
3. Client calls create with that `object_key`.

Step 2 failing just leaves an orphaned object in the bucket — never a half
created reel row.

The headers are **signed**, so they are not advisory: a different `Content-Type`
or a missing `x-amz-acl` makes Spaces reject the upload. They are returned to the
caller so nothing has to be guessed.

## API

All endpoints take the app token as the last path segment. Writes also take
`id` (user id) and `key` (`sha1` of the stored password hash), the same check
the pack upload endpoint uses.

| Method | Path | Purpose |
|---|---|---|
| GET | `/api/reel/feed/{page}/{user}/{token}/` | Newest reels from everyone. `user` is the viewer, `0` when logged out — it only decides the `liked` and `following` flags. |
| GET | `/api/reel/by/follow/{page}/{user}/{token}/` | Reels from people this user follows. |
| GET | `/api/reel/by/user/{page}/{author}/{user}/{token}/` | One author's reels. |
| POST | `/api/reel/upload/url/{token}/` | `id`, `key`, `type` (`video`/`photo`), `ext`, `thumbext` → presigned slots. Videos get a second slot for the poster frame. |
| POST | `/api/reel/create/{token}/` | `id`, `key`, `objectkey`, `thumbkey`, `type`, `caption`, `width`, `height`, `duration`. |
| POST | `/api/reel/like/{reelId}/{token}/` | `id`, `key`. Toggles; returns `liked` and the new count. |
| POST | `/api/reel/view/{reelId}/{token}/` | Bumps the view counter. |
| POST | `/api/reel/delete/{reelId}/{token}/` | `id`, `key`. Author only. |

The reel id is `reelId` in the path, deliberately not `id`: Symfony resolves
`Request::get('id')` from the route parameters before the POST body, so a route
placeholder called `id` would shadow the posted user id and every write would
look up a user by reel id.

Pages are 20 reels. Feeds return only reels that are enabled and past review, so
a hidden or pending reel can never leak into a public feed.

A reel in the feed:

```json
{
  "id": "12", "type": "video",
  "url": "https://…/reels/7/2026/02/ab12.mp4",
  "thumb": "https://…/reels/7/thumbs/2026/02/cd34.jpg",
  "caption": "…", "width": 1080, "height": 1920, "duration": 14,
  "likes": 24, "views": 310, "liked": "false", "created": "2 hours ago",
  "userid": "7", "user": "Pranay", "userimage": "…", "trusted": "true",
  "following": "false"
}
```

## Ads in Reels

Reels ads are the **native** format, and use the same settings and the same seven
network waterfall as the ads in the pack lists — there is no separate ad account
or unit id for reels. Switching Native off in the panel removes them from the
Reels feed and the full screen player too.

| Where | Format | Controlled by |
|---|---|---|
| Reels feed, a card every N reels | Native | `ADMIN_NATIVE_*` + `ADMIN_REELS_NATIVE_LINES` |
| Full screen player, a page every N reels | Native | same |

`ADMIN_REELS_NATIVE_LINES` ("Reels between two native ads") is separate from the
pack lists' "Packs between two native ads", so the reels feed can be tuned
without changing the rest of the app. Leave it empty and it uses the pack value.

## Moderation

Reels uploaded **from the app** wait in *Reels to review* by default. Settings →
"Reels uploaded from the app" switches to publishing straight away. Reels added
from the panel are always live immediately.

Deleting a reel removes the database row; the object stays in your Space. That is
deliberate — a delete is instant and can't fail halfway. Prune the bucket
separately if storage matters.

## Ownership check

`create` verifies the object key starts with `reels/{userId}/`, which is the
prefix the presign endpoint issued to that user. Without it, one user could pass
another user's key and claim their file.
