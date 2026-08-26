-- ---------------------------------------------------------------------------
-- The Reels on/off switch for the app.
--
-- Adds settings_table.reelsenabled, the choice on the Settings page. Existing
-- installs are set to TRUE so nothing disappears on upgrade. Safe to run twice.
-- ---------------------------------------------------------------------------

SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'reelsenabled') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `reelsenabled` varchar(255) DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

UPDATE `settings_table` SET `reelsenabled` = COALESCE(`reelsenabled`, 'TRUE');
