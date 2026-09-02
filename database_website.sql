-- The website: its own name, description, keywords, logo, and a switch.
--
-- All nullable and all with fallbacks in the entity, so an install that runs
-- this and changes nothing keeps working exactly as before - the site simply
-- borrows the app's name and description until you give it its own.
--
-- Safe to run twice.

SET @exists := (SELECT COUNT(*) FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'settings_table' AND COLUMN_NAME = 'sitename');
SET @sql := IF(@exists = 0,
    'ALTER TABLE settings_table ADD sitename VARCHAR(255) DEFAULT NULL',
    'SELECT "sitename already there"');
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @exists := (SELECT COUNT(*) FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'settings_table' AND COLUMN_NAME = 'sitedescription');
SET @sql := IF(@exists = 0,
    'ALTER TABLE settings_table ADD sitedescription TEXT DEFAULT NULL',
    'SELECT "sitedescription already there"');
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @exists := (SELECT COUNT(*) FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'settings_table' AND COLUMN_NAME = 'sitekeywords');
SET @sql := IF(@exists = 0,
    'ALTER TABLE settings_table ADD sitekeywords VARCHAR(500) DEFAULT NULL',
    'SELECT "sitekeywords already there"');
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @exists := (SELECT COUNT(*) FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'settings_table' AND COLUMN_NAME = 'siteenabled');
SET @sql := IF(@exists = 0,
    'ALTER TABLE settings_table ADD siteenabled VARCHAR(255) DEFAULT NULL',
    'SELECT "siteenabled already there"');
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @exists := (SELECT COUNT(*) FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'settings_table' AND COLUMN_NAME = 'logo_id');
SET @sql := IF(@exists = 0,
    'ALTER TABLE settings_table ADD logo_id INT DEFAULT NULL',
    'SELECT "logo_id already there"');
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @exists := (SELECT COUNT(*) FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'settings_table' AND INDEX_NAME = 'settings_logo_idx');
SET @sql := IF(@exists = 0,
    'CREATE INDEX settings_logo_idx ON settings_table (logo_id)',
    'SELECT "index already there"');
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;
