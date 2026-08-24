-- ---------------------------------------------------------------------------
-- Ad waterfall upgrade for settings_table
--
-- Adds a unit id per network for every ad format, an explicit waterfall order,
-- and the global controls the app reads (Unity game id, per network timeout,
-- automatic fallback switch, download placement).
--
-- Safe to run on an existing database: every column is added as NULL-able and
-- the existing values are kept.
-- ---------------------------------------------------------------------------

ALTER TABLE `settings_table`
  ADD COLUMN `rewardedtype`           varchar(255) DEFAULT NULL,
  ADD COLUMN `bannermaxid`            varchar(255) DEFAULT NULL,
  ADD COLUMN `bannerapplovinid`       varchar(255) DEFAULT NULL,
  ADD COLUMN `bannerunityid`          varchar(255) DEFAULT NULL,
  ADD COLUMN `bannerorder`            varchar(255) DEFAULT NULL,
  ADD COLUMN `nativemaxid`            varchar(255) DEFAULT NULL,
  ADD COLUMN `nativeorder`            varchar(255) DEFAULT NULL,
  ADD COLUMN `interstitialmaxid`      varchar(255) DEFAULT NULL,
  ADD COLUMN `interstitialapplovinid` varchar(255) DEFAULT NULL,
  ADD COLUMN `interstitialunityid`    varchar(255) DEFAULT NULL,
  ADD COLUMN `interstitialorder`      varchar(255) DEFAULT NULL,
  ADD COLUMN `rewardedmaxid`          varchar(255) DEFAULT NULL,
  ADD COLUMN `rewardedapplovinid`     varchar(255) DEFAULT NULL,
  ADD COLUMN `rewardedfacebookid`     varchar(255) DEFAULT NULL,
  ADD COLUMN `rewardedunityid`        varchar(255) DEFAULT NULL,
  ADD COLUMN `rewardedorder`          varchar(255) DEFAULT NULL,
  ADD COLUMN `unitygameid`            varchar(255) DEFAULT NULL,
  ADD COLUMN `adfallback`             varchar(255) DEFAULT NULL,
  ADD COLUMN `downloadadtype`         varchar(255) DEFAULT NULL,
  ADD COLUMN `adtimeout`              int(11)      DEFAULT NULL;

-- The panel used to store the rewarded ad type in `bannerfacebookid`, because
-- there was no column of its own for it. Move those values into the new
-- `rewardedtype` column and clear the field so it can hold what its name says:
-- the Meta Audience Network banner placement id.
UPDATE `settings_table`
   SET `rewardedtype` = `bannerfacebookid`
 WHERE `bannerfacebookid` IN ('FALSE', 'ADMOB', 'MAX', 'APPLOVIN', 'IS', 'FACEBOOK', 'UNITY');

UPDATE `settings_table`
   SET `bannerfacebookid` = NULL
 WHERE `bannerfacebookid` IN ('FALSE', 'ADMOB', 'MAX', 'APPLOVIN', 'IS', 'FACEBOOK', 'UNITY');

-- Sensible defaults for the new controls.
UPDATE `settings_table`
   SET `rewardedtype`   = COALESCE(`rewardedtype`, 'FALSE'),
       `adfallback`     = COALESCE(`adfallback`, 'TRUE'),
       `adtimeout`      = COALESCE(`adtimeout`, 10),
       `downloadadtype` = COALESCE(`downloadadtype`, 'FALSE'),
       -- Show a native ad every 3 packs in the lists unless already configured.
       `nativeitem`     = COALESCE(`nativeitem`, 3);
