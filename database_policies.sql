-- The delete account policy and the terms.
--
-- The privacy policy already had a column; these two did not exist, even though
-- Play asks for a delete account address from any app that lets people make an
-- account. Both nullable: an install that runs this and writes nothing has three
-- pages that say the document has not been written yet, and nothing breaks.
--
-- Safe to run twice.

SET @exists := (SELECT COUNT(*) FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'settings_table' AND COLUMN_NAME = 'deleteaccount');
SET @sql := IF(@exists = 0,
    'ALTER TABLE settings_table ADD deleteaccount TEXT DEFAULT NULL',
    'SELECT "deleteaccount already there"');
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @exists := (SELECT COUNT(*) FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'settings_table' AND COLUMN_NAME = 'terms');
SET @sql := IF(@exists = 0,
    'ALTER TABLE settings_table ADD terms TEXT DEFAULT NULL',
    'SELECT "terms already there"');
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;
