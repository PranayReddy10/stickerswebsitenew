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
| `/reels/<id>.html` | a screen of its own between reels, at the same interval, as you scroll |

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
- your own banner fills the width up to 728px and scales down from there;
- margins tighten under 620px so an ad costs less of a small screen;
- a slot your network does not fill is hidden a moment after the page settles,
  label and all, rather than leaving "Advertisement" sitting over nothing.

A responsive unit from your network will size itself and simply fit.

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
