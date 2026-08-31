# Pack images — where they are stored

Sticker packs used to have one home: `public_html/uploads/`, on the server that
runs the panel. The reels already keep their media in a DigitalOcean Space, and
the *New Pack* page now offers the same choice for a pack's pictures.

## The choice

On **Packs → Add**, above the file pickers:

| Button | What happens |
| --- | --- |
| **DigitalOcean Spaces** | The tray image and every sticker are sent to the same Space the reels use. The `media_table.url` column holds the finished `https://…` URL. |
| **This server** | The files are moved into `public_html/uploads/<ext>/`, exactly as before. `media_table.url` holds a file name. |

The choice covers the whole pack, so a pack is never half in one place and half
in the other. Editing a pack later follows what that pack already uses: a
replacement tray image, or a sticker added from **Pack → Stickers**, goes
wherever the rest of that pack's pictures are.

If no Space is configured the Spaces button is greyed out with the reason on it,
and *This server* is preselected. Nothing else changes — packs added before this
existed keep working untouched.

## Setup

Nothing new. It uses the same six `spaces_*` values in
`app/config/parameters.yml` that the reels need — see `docs_REELS.md`. No
migration: `media_table.url` has always been wide enough for a URL, and
`Media::getLink()` has always returned a URL unchanged when it finds one.

## What it changes downstream

* **The app** gets an absolute URL in `tray_image_file`, `image_file` and
  `image_file_thum` for a pack kept in the Space. It already handles those:
  storage URLs are what reels have always sent.
* **Thumbnails.** LiipImagine resizes files on this server's disk, so it cannot
  touch a file in the Space. Pack pictures kept there are served at the size
  they were uploaded, the same way animated stickers already were. Upload a
  tray image around 300×300 and stickers at 512×512 and there is nothing to
  resize anyway.
* **Deleting** a pack, a sticker, or a replaced image removes the object from
  the Space as well. A bucket that will not answer is logged and ignored, so
  the row still goes.

## Packs uploaded from the app

Uploads that come in through the app's own *Create pack* screen still go to this
server. They have no panel to ask, and the choice is deliberately per-pack
rather than a site-wide switch.
