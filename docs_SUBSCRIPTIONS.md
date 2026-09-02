# Subscriptions — panel

Google Play sells the subscription and Play decides who has one. What Play will
not tell you is **which of your users** is paying, **which device** they use, or
**how many times** they have subscribed before. The app is the only place those
facts meet, so the app reports them and the panel keeps the record.

## Setup

```
mysql -u USER -p DATABASE < database_subscriptions.sql
```

One table, safe to run twice. Nothing else to configure: the reports come in on
the app token that every other endpoint already uses.

Then **Subscriptions** appears in the panel menu, and the dashboard gains a
*Subscribed now* card.

## How it works

The app already asks Play at every launch whether this device has a live
subscription — that is what switches the ads off. It now also says so:

1. Play returns a live subscription → the app posts the purchase token, product,
   order id, purchase time, whether it is set to renew, the device id and the
   signed-in user if there is one.
2. Play returns nothing, and this device had reported a subscription before →
   the app posts that it is over.

`subscription/report` keys on the **purchase token**, so one purchase is one
row however many times it is reported; each report bumps `checks` and `updated`
rather than adding a row. The app reports a given purchase at most once a day.

The device id is the same `ANDROID_ID` the app already sends when it registers
for notifications, so a subscriber lines up with a device you already have.

## What "subscribed now" means

A row counts as live when its state is active **and** it has been confirmed in
the last **5 days** (`Subscription::STALE_DAYS`).

The second half matters. A phone that is switched off, or has the app
uninstalled, stops confirming, and nothing tells the server. Without the
staleness rule the total could only ever grow, and the page would say you have
more subscribers every month for ever. Change the constant if your users open
the app less often than that.

## What the page shows

* **Cards** — subscribed now, ever subscribed, how many are signed-in accounts,
  how many devices.
* **Last 14 days** — new subscriptions per day.
* **Where they stand** — renewing, cancelled but still running, ended, and how
  many bought without ever signing in.
* **By product** — live and lifetime counts per product id.
* **Subscribed more than once** — devices that came back after lapsing.
* **The list** — every subscription with who, which device, product, state, when
  it started, how long it has been running, when it was last confirmed, and how
  many times it has been confirmed. Filterable to live or ended.

## Days, expiry and who counts them

Google handles the subscription itself: the billing period, the charge, the
renewal, the grace period and the cancellation. None of that is decided here.

What Play hands the **device** is smaller than people expect. A `Purchase`
carries the product, the purchase token, the order id, the time it was bought
and whether it is set to auto-renew — and **no expiry date**. So the panel
cannot say "expires in 6 days", and the "running" column counts up from the
purchase rather than down to the end.

That is also why a subscription is judged live by whether the app has confirmed
it recently rather than by a date. Play stops returning a purchase once it has
lapsed; the next launch reports that it is gone.

**Re-subscribing** makes a new purchase with a new token, which is a new row —
and reporting it closes whatever that device had before, because Play only ever
returns the one current purchase per device. A row that stops renewing keeps its
token and changes state, and the app reports that the same day rather than
waiting for the next one.

If you want real expiry dates, renewal counts and a subscription's full history,
the server has to ask Google rather than the phone: a Play service account with
the Android Publisher API, and `purchases.subscriptionsv2.get` called with the
token every row already stores.

## What this is not

This is the app's report, not Play's word. It is right for counting your own
subscribers and seeing who they are; it is not a receipt, and it is not
tamper-proof — a modified app could post whatever it liked. It grants nothing
either: the entitlement still comes from Play's own check on the device, so a
false report buys nobody anything.

If you later want the server to confirm each purchase with Google directly, that
means a Play service account with the Android Publisher API, and
`purchases.subscriptionsv2.get` called with the token this table already stores.
Everything needed for it is in the row; say the word and it can be added.
