# The website

Everything in the app already existed as data an API hands to phones. What it
had no way of being was a **page**: nothing could be shared into a chat with a
preview, nothing could be found in a search, and somebody sent a link had to
install the app before they could see what they had been sent.

Now every pack and every reel has a page.

## Setup

```
mysql -u USER -p DATABASE < database_website.sql
```

Five nullable columns on `settings_table`, all with fallbacks, so an install
that runs this and changes nothing keeps working exactly as before.

Then open **Website** in the panel (or Settings → Website) and give the site its
own name, description and logo. All three are optional — left empty, the site
borrows the app's.

Finally, hand `https://your-domain/sitemap.xml` to Google Search Console once.

## The pages

| Address | What it is |
| --- | --- |
| `/` | The site, for anybody signed out. Signed in as an admin you get the panel, exactly as before. |
| `/home.html` | The same front page at a fixed address. |
| `/stickers.html` | Every published pack, newest first, filterable by category. |
| `/stickers/{id}.html` | One pack: its stickers, who made it, and the way to get it. |
| `/reels.html` | Every live reel. |
| `/reels/{id}.html` | One reel, playing. |
| `/sitemap.xml` | Built on the fly from what is actually published. |
| `/robots.txt` | Points at the sitemap and keeps crawlers out of the panel. |

`/share/{id}.html` and `/share/reel/{id}.html` still work — the first redirects
permanently to the pack's page, the second is the reel's page with a canonical
tag pointing at `/reels/{id}.html`, so a link already out in the world keeps
working and search engines count one address rather than two.

## The policy pages

Three documents, edited in **Policies** in the panel, each a public page:

| Address | What it is for |
| --- | --- |
| `/privacy_policy.html` | The Play listing. An app cannot be published without this address answering. |
| `/delete-account.html` | Play's data safety form asks for this from any app that lets people make an account. |
| `/terms.html` | The store listing and the app itself. |

They are **not** behind the website switch and never behind the panel login. A
policy page that answered 404 because the site was switched off would take the
store listing with it.

The panel lists all three full addresses ready to paste into Play Console, and
the settings API sends them to the app as `ADMIN_PRIVACY_URL`,
`ADMIN_DELETE_ACCOUNT_URL` and `ADMIN_TERMS_URL`, so a build can link to them
rather than carry its own copy that goes stale.

Run `database_policies.sql` for the two new columns; the privacy policy already
had one and keeps whatever is in it.

## The root is shared

A site wants to live at the root — that is where a link, a crawler and a person
all arrive — and the panel has always been there. `/` now answers with the
dashboard for a signed-in admin and the site for everybody else. One condition
decides, and every dashboard query sits on the far side of it, so an anonymous
visitor never reaches any of them.

## What the site will not do

It shows stickers; it does not hand them out. Adding a pack to WhatsApp is
something only the app can do — WhatsApp accepts packs through the content
provider inside an installed app and nowhere else — so every page ends at the
Play store rather than at a download. The same goes for reels: they play, and
that is all.

Nothing on the site writes anything. There is no form, no upload and no login on
any of it.

## Switching it off

**Website → The site itself → Off** makes every public page answer 404 and
empties the sitemap. The panel and the app carry on unchanged. Off means off:
the pages are gone rather than blank, because a blank page is still a page
somebody can land on and a crawler can index.
