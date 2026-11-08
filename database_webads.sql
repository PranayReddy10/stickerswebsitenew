-- Ads on the public website: whether they are on, the network's code for each
-- slot, how far apart the in-grid ones sit, and your own banner for the slots
-- the network does not fill.
--
-- Nothing here touches the app's own ad settings, which live in their own
-- columns and are served to the app, not rendered into a page.
--
-- All nullable and off until switched on, so an install that runs this and
-- changes nothing behaves exactly as before.
--
-- Safe to run twice.

DROP PROCEDURE IF EXISTS add_webads_column;
DELIMITER //
CREATE PROCEDURE add_webads_column(IN colname VARCHAR(64), IN coltype VARCHAR(64))
BEGIN
    IF NOT EXISTS (SELECT 1 FROM information_schema.COLUMNS
        WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'settings_table'
          AND COLUMN_NAME = colname) THEN
        SET @sql := CONCAT('ALTER TABLE settings_table ADD ', colname, ' ', coltype,
            ' DEFAULT NULL');
        PREPARE stmt FROM @sql;
        EXECUTE stmt;
        DEALLOCATE PREPARE stmt;
    END IF;
END //
DELIMITER ;

CALL add_webads_column('webadsenabled', 'VARCHAR(255)');
CALL add_webads_column('webadshead', 'TEXT');
CALL add_webads_column('webadstop', 'TEXT');
CALL add_webads_column('webadsfeed', 'TEXT');
CALL add_webads_column('webadsbottom', 'TEXT');
CALL add_webads_column('webadsevery', 'INT');
CALL add_webads_column('webadsbannerurl', 'VARCHAR(500)');
CALL add_webads_column('webadsbannertext', 'VARCHAR(255)');
CALL add_webads_column('webadsbanner_id', 'INT');
CALL add_webads_column('webadsreelbanner_id', 'INT');

DROP PROCEDURE add_webads_column;

-- An index on the banner, the same as the website logo got. No foreign key:
-- that is the pattern already used for logo_id here, and it keeps this file
-- safe to run against a settings table whose media rows live anywhere.
SET @exists := (SELECT COUNT(*) FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'settings_table'
      AND INDEX_NAME = 'settings_webadsbanner_idx');
SET @sql := IF(@exists = 0,
    'CREATE INDEX settings_webadsbanner_idx ON settings_table (webadsbanner_id)',
    'SELECT "index already there"');
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @exists := (SELECT COUNT(*) FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'settings_table'
      AND INDEX_NAME = 'settings_webadsreelbanner_idx');
SET @sql := IF(@exists = 0,
    'CREATE INDEX settings_webadsreelbanner_idx ON settings_table (webadsreelbanner_id)',
    'SELECT "index already there"');
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;
