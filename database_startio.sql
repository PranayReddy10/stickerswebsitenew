-- Start.io: one app id covers banner, MREC, native, interstitial and rewarded, so there
-- are no placement ids to store. Safe to run twice.
SET @exists := (SELECT COUNT(*) FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'settings_table'
      AND COLUMN_NAME = 'startioappid');
SET @sql := IF(@exists = 0,
    'ALTER TABLE settings_table ADD startioappid VARCHAR(255) DEFAULT NULL',
    'SELECT "startioappid already there"');
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
