# Ads on the website

The public site can carry ads on the sticker pack and reel pages. Two ways to
fill a slot: paste your ad network's code, or upload a banner of your own.

Run `database_webads.sql` once. Nine nullable columns on `settings_table`, ads
off until you switch them on, safe to run twice.

**Panel → Website ads** (`/website-ads.html`).

## The slots

| Page | Where the ads land |
|---|---|
| `/stickers.html` | above, inside and below the grid |
| `/stickers/<id>.html` | above and below the pack |
| `/reels.html` | above, inside and below the grid; the in-grid ones keep coming as more reels load |
| `/reels/<id>.html` | a strip under every reel's views and likes, and a screen of its own between reels |

The network's loader script goes in `<head>` on every one of them.

"Packs or reels between in-grid ads" sets N. Blank, or anything under 3, means
8; over 50 is clamped to 50. That is deliberate — a 0 there would put an ad
between every second pack and is one mistyped digit away.

## Network code, or your own banner

Each slot's box takes whatever your network gave you. It is written into the
page exactly as typed, because that is the only way such a tag can work — which
makes this an admin-only screen in the strongest sense: whatever is saved there
runs in every visitor's browser. Put nothing in it but the network's own code.

A slot you leave empty falls back to **your own banner** — an image, a link and
an optional line of text. So a site with no ad network at all can still carry
house ads for another of your apps or for the shop. A banner with no address is
never shown; there would be nowhere to send anyone.

### Banner sizes

There are two banners, because the slots are different shapes. One address and
one caption serve both — it is the same advertiser either way.

| Banner | Aim for | Also fine | Shown at |
|---|---|---|---|
| Wide — pages and grids | **970 × 250** | 728 × 90, 1200 × 300 | up to 970px across |
| Tall — between reels | **1080 × 1350** | 1080 × 1920 | up to 440px across, max ~72% of screen height |

Anything narrower than 728 looks soft on a desktop. The tall one is optional:
leave it empty and the wide banner is used between reels as well, just smaller.

The panel prints the real pixel size of whatever you uploaded, next to the size
it should be — a banner can look fine in the form and still be far too small for
the slot it lands in, and the number is the only way to tell.

### Sizes for network code

Ask your network for a **responsive** unit where you can: it measures the slot
and fills it, which is what makes the same code work on a phone and a desktop.
If you have to pick fixed sizes:

| Slot | Sizes that fit |
|---|---|
| Above and below the grid | 728 × 90 or 970 × 250 on desktop; 320 × 100 on a phone |
| Inside the grid | 336 × 280 or 300 × 250 — it has a full row to itself |
| Between reels | 300 × 250, or a portrait 320 × 480 |
| Under a reel | **320 × 50** — an AdMob banner; 320 × 100 also fits |

A slot with no code and no banner renders nothing at all: no empty box, no gap.

The master switch wins over everything. Off means nothing is rendered anywhere,
whatever is saved — so you can set all of this up before turning it on.

## How they look, and how they size

Every slot sits on its own row, labelled "Advertisement" above it, with space
around it. An in-grid ad takes the full width rather than sitting in the grid
pretending to be a pack. That is not decoration: a visitor should never mistake
an ad for one of your packs, and most ad networks require the label anyway.

**Sizing is by the space available, not a fixed number**, so the same code works
on a phone and on a desktop:

- the slot is as wide as the column it is in, and whatever the network puts
  inside it — an `iframe`, an `<ins>`, a picture — is held to that width;
- the box clips, so a fixed-size unit on a narrow phone cannot push the page
  sideways;
- your own banner fills the width up to 970px and scales down from there;
- between reels the banner is capped at 440px across and about 72% of the screen
  height, and keeps its own shape rather than being stretched;
- margins tighten under 620px so an ad costs less of a small screen;
- a slot your network does not fill is hidden a moment after the page settles,
  label and all, rather than leaving "Advertisement" sitting over nothing.

A responsive unit from your network will size itself and simply fit.

## The strip under a reel

**Under each reel** is its own slot, below the views and likes, on every reel
rather than every Nth. It is separate from the screen-sized ad between reels —
fill either, both or neither.

It is an **AdMob banner slot: 320 × 50**. That is what the box is sized for —
320 wide, 50 tall, centred under the reel. A 320 × 100 large banner is let
through rather than clipped, since clipping an ad breaks most networks' terms,
but 50 is the size to ask for.

A reel's screen is full already, so the clip gives up a little height to make
room: 68% of the screen instead of 78%, and 58% on a short one. That trade only
happens when the slot is actually set; with it empty the reel is exactly as tall
as before.

A strip the network does not fill is hidden like any other slot, and the clip
keeps the smaller size rather than jumping — worth knowing if you are testing
with an unfilled unit.

## One reel leads to the next

`/reels/<id>.html` used to be a dead end: one reel, and a link back to the list.
It is a feed now. The reel you opened fills the screen, and scrolling brings the
next one, and the next, the way the app does — snapping one reel per screen,
playing only the one you are looking at, and loading five at a time as you near
the end.

The address bar follows along, so sharing from halfway down shares the reel
being watched rather than the one that was opened.

The reel asked for is still written into the HTML rather than fetched, so a
crawler and a chat app's link preview both see it without running any script,
and the page's `og:` tags are unchanged.

Sound starts off, because a browser will not autoplay with it on. One tap turns
it on for the whole feed.

Each batch comes from:

```
GET /reels/<id>/next.json  ->  {"html": "…", "more": true, "last": 1234}
```

It asks for everything older than the reel you are on rather than counting an
offset, so a reel posted while somebody is scrolling cannot shift the window
under them and make one repeat.

## Reels keep loading

`/reels.html` now loads the next 24 reels as you near the bottom, rather than
making you find a pager. The in-grid ads come with them, at the same interval,
all the way down.

The page asks for each batch from:

```
GET /reels/page/{page}.json   ->  {"html": "<the cells>", "more": true}
```

It returns rendered HTML rather than rows of JSON so the cells come from the
same template the first page uses — the two cannot drift apart. The query asks
for one reel more than a page and reports whether it came back, which is how
`more` is known without counting the whole table on every scroll.

The old pager is still in the page for crawlers and for anyone without
JavaScript; the script hides it, so nobody sees both. If three requests in a
row fail, the script gives up and puts the pager back rather than leaving
somebody scrolling at a wall.

## What this does not touch

The app's own ads. Those live on **Panel → Ads**, are served to the app as
settings, and have nothing to do with these. Changing one never affects the
other.

---

# Your own ads, in the app

Different thing from everything above: these go in the **app**, not the website.
Panel → **Your own ads** (`/house-ads.html`).

They sit last in the app's waterfall. Every network ahead of them pays and these
do not, so they only take the slots nobody bought — but unlike a network they
can never fail to fill, and they work on a phone that cannot reach a single ad
network, because the creatives come down with the settings and are cached.

## One ad, one shape

| Format | Where it lands | Picture |
|---|---|---|
| Banner | the strip at the bottom of a screen | 640 × 100 |
| MREC | the box between packs | 600 × 500 |
| Native | a card in the list, built from the words | 1200 × 628 |
| Interstitial | the full page between screens | 1080 × 1920 |
| Rewarded | the full page somebody opted into | 1080 × 1920 |

Sizes are twice the slot so they stay sharp on a dense screen. Every format
needs an address; every format except native needs a picture, since native is
drawn from the headline, the line under it and the button.

Within one format the **share** decides how often each ad is picked — two at 1
and 3 means the second is shown three times as often.

## What you can see

The list page shows, in total and per format: **impressions, clicks and the
click rate**, plus a fourteen-day chart with impressions in pale and clicks over
them, and the same three numbers per ad.

The app reports an impression when the ad is actually on screen and a click when
it is tapped. Both land on the ad's running total and on its row for today.

Counting is done in SQL — `impressions = impressions + 1`, and an
`INSERT … ON DUPLICATE KEY UPDATE` for the day row — rather than read-then-write
in PHP, because a popular ad is reported by many phones at once and anything
that reads a number into PHP first loses some of them. The unique key on
(ad, day) is what makes that upsert safe.

Deleting an ad takes its day rows with it, so the totals and the chart can never
disagree.

## The endpoints

```
GET  /api/house/ads/{token}/{purchase}/            the creatives, with a cache time
GET  /api/house/impression/{id}/{token}/{purchase}/
GET  /api/house/click/{id}/{token}/{purchase}/
```

An ad deleted since a phone cached it answers "gone" rather than an error —
there is nothing to count and nothing worth failing over.
