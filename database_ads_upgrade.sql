-- ---------------------------------------------------------------------------
-- Ad settings upgrade for settings_table
--
-- SAFE TO RUN AS MANY TIMES AS YOU LIKE. Each column is added only if it is not
-- already there, so running this after a partial upgrade simply fills in the
-- gaps. Paste the whole file into phpMyAdmin's SQL tab, or:
--
--     mysql -u USER -p DATABASE < database_ads_upgrade.sql
--
-- Skipped columns show up as a "1" result row; that is the no-op, not an error.
--
-- What it adds:
--   * a unit id per network for banner, native, interstitial and rewarded
--     (AppLovin MAX, AppLovin direct, Meta, Unity, Vungle, InMobi)
--   * an explicit waterfall order per format
--   * the account level credentials: Unity game id, Vungle app id,
--     InMobi account id
--   * the global controls: per network timeout, automatic fallback switch
--   * rewardedtype, which used to be squatting in bannerfacebookid
-- ---------------------------------------------------------------------------

SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'rewardedtype') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `rewardedtype` varchar(255) DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'bannermaxid') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `bannermaxid` varchar(255) DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'bannerapplovinid') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `bannerapplovinid` varchar(255) DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'bannerunityid') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `bannerunityid` varchar(255) DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'bannerorder') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `bannerorder` varchar(255) DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'nativemaxid') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `nativemaxid` varchar(255) DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'nativeorder') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `nativeorder` varchar(255) DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'interstitialmaxid') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `interstitialmaxid` varchar(255) DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'interstitialapplovinid') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `interstitialapplovinid` varchar(255) DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'interstitialunityid') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `interstitialunityid` varchar(255) DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'interstitialorder') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `interstitialorder` varchar(255) DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'rewardedmaxid') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `rewardedmaxid` varchar(255) DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'rewardedapplovinid') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `rewardedapplovinid` varchar(255) DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'rewardedfacebookid') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `rewardedfacebookid` varchar(255) DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'rewardedunityid') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `rewardedunityid` varchar(255) DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'rewardedorder') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `rewardedorder` varchar(255) DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'unitygameid') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `unitygameid` varchar(255) DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'adfallback') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `adfallback` varchar(255) DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'adtimeout') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `adtimeout` int DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'vungleappid') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `vungleappid` varchar(255) DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'inmobiaccountid') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `inmobiaccountid` varchar(255) DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'bannervungleid') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `bannervungleid` varchar(255) DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'bannerinmobiid') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `bannerinmobiid` varchar(255) DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'interstitialvungleid') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `interstitialvungleid` varchar(255) DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'interstitialinmobiid') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `interstitialinmobiid` varchar(255) DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'rewardedvungleid') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `rewardedvungleid` varchar(255) DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'rewardedinmobiid') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `rewardedinmobiid` varchar(255) DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

-- ---------------------------------------------------------------------------
-- The panel used to store the rewarded ad type in `bannerfacebookid`, because
-- there was no column of its own for it. That meant the app was also handed
-- that value as its Meta banner placement id. Move it across and clear the
-- field so it can hold what its name says.
--
-- The WHERE clause only matches the old type keywords, so a real Meta
-- placement id that has since been entered is left alone, and a second run
-- does nothing.
-- ---------------------------------------------------------------------------

UPDATE `settings_table`
   SET `rewardedtype` = `bannerfacebookid`
 WHERE `bannerfacebookid` IN ('FALSE', 'ADMOB', 'MAX', 'APPLOVIN', 'IS', 'FACEBOOK', 'UNITY');

UPDATE `settings_table`
   SET `bannerfacebookid` = NULL
 WHERE `bannerfacebookid` IN ('FALSE', 'ADMOB', 'MAX', 'APPLOVIN', 'IS', 'FACEBOOK', 'UNITY');

-- Defaults for anything still unset.
UPDATE `settings_table`
   SET `rewardedtype`   = COALESCE(`rewardedtype`, 'FALSE'),
       `adfallback`     = COALESCE(`adfallback`, 'TRUE'),
       `adtimeout`      = COALESCE(`adtimeout`, 10),
       -- A native ad every 3 packs in the lists unless already configured.
       `nativeitem`     = COALESCE(`nativeitem`, 3);
