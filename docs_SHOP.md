# The shop

You sell things somewhere else — a shop of your own with its own product API —
and you want the app to carry people there. This is how that is wired.

## What was added

| Piece | Where |
|---|---|
| Six settings columns | `database_shop.sql` |
| The switches and their helpers | `src/AppBundle/Entity/Settings.php` |
| The settings form | `src/AppBundle/Form/ShopType.php` |
| The settings screen | `src/AppBundle/Resources/views/Home/shop.html.twig` (route `/shop.html`) |
| The proxy and the test button | `src/AppBundle/Controller/ShopController.php` |
| What the app is told | `src/AppBundle/Controller/VersionController.php` |
| The link on the public website | `src/AppBundle/Resources/views/Site/layout.html.twig` |

Run `database_shop.sql` once. It adds six nullable columns to `settings_table`
and leaves the shop off, so until you switch it on nothing changes anywhere.

## The settings screen

**Panel → Shop.**

- **Shop** — on or off. Off is the master switch: the app is told nothing, the
  website shows no link, and the product proxy answers 503.
- **Show the button in the app** — separate from the switch above, so you can
  have the products without having the menu item (or the other way round while
  you are still setting the shop up). It needs a website address to point at,
  or it stays off whatever this says.
- **Button label** — what the menu item says. Blank means "Shop".
- **Shop website** — where the button goes.
- **Product API** — only if it is not `<website>/api/v1/products`, which is
  what is assumed.
- **API key** — write-only. See below.

"Ask the shop now" on that screen calls the shop straight away, bypassing the
cache, and tells you how many products came back and the first one's name. Use
it after changing the key or the address: it is the difference between "saved"
and "working".

## The key stays here

The key is stored in `settings_table.shopapikey` and read in exactly two
places: when the panel asks the shop, and when the app's proxy asks the shop.

It is **not** in the settings the app downloads, and it is **not** rendered into
any page. The field on the settings screen is a password box that always comes
up empty and is not mapped to the entity — type a new key to replace the old
one, leave it blank to keep what is there. That is deliberate: anything sent to
a phone is readable by anybody who unzips the APK, and a product key that
leaked that way would have to be rotated on the shop's side, not here.

So the app never talks to the shop's API directly. It asks this server:

```
GET /api/shop/products/{token}/{purchase}/?page=1&per_page=20
```

Same token check as every other app endpoint. Only `page`, `per_page`,
`category`, `q`, `search` and `sku` are passed upstream — anything else is
dropped rather than forwarded — and `per_page` is clamped to 1–50. The shop's
JSON is returned exactly as it arrived, numbers and all, so the app can read
whatever fields the shop grows later without this proxy needing to know about
them.

Answers are cached in `app/cache/<env>/shop` for five minutes, keyed by the
query. A busy day therefore costs the shop twelve calls an hour, not one per
phone. Clearing the Symfony cache clears this too.

## What the app is told

In the settings payload (`/settings/...`):

```
ADMIN_SHOP_ENABLED   TRUE / FALSE
ADMIN_SHOP_BUTTON    TRUE / FALSE
ADMIN_SHOP_NAME      the button label
ADMIN_SHOP_URL       the shop website
```

The app shows the menu item only when `ADMIN_SHOP_BUTTON` is `TRUE`, which
means you can turn it on and off for every install from the panel without
shipping a build.

## If the test button complains

- **"The shop refused the API key"** — 401 or 403 upstream. Re-type the key;
  check whether the shop expects it as a header (this sends `X-Api-Key`).
- **"That does not look like a web address"** — the Product API field holds
  something `FILTER_VALIDATE_URL` will not accept.
- **A timeout** — the shop took longer than 15 seconds. The app's proxy gives up
  the same way and the app should simply not show products; the button still
  works, because the button is just a link.
