-- ---------------------------------------------------------------------------
-- Native placements for Vungle and InMobi.
--
-- Both networks serve native ads, so they can now take part in the native
-- waterfall alongside AdMob, MAX and Meta. Safe to run more than once.
-- ---------------------------------------------------------------------------

SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'nativevungleid') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `nativevungleid` varchar(255) DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'nativeinmobiid') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `nativeinmobiid` varchar(255) DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;
