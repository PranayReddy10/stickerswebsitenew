-- What the panel needs to answer "how busy was today": when a device last opened
-- the app, and when a reel was last watched.
--
-- The app registers for notifications every time the home screen opens, so that
-- endpoint was already an "app opened" ping - it just was not written down.
-- Recording it is what makes "active today" answerable, with no app update.
--
-- created and seen are nullable on purpose: the devices already in the table
-- were never dated, and pretending they were seen today would be a lie. The
-- panel shows their count separately.
--
-- Safe to run twice.

SET @exists := (SELECT COUNT(*) FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'device_table' AND COLUMN_NAME = 'created');
SET @sql := IF(@exists = 0,
    'ALTER TABLE device_table ADD created DATETIME DEFAULT NULL',
    'SELECT "created already there"');
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @exists := (SELECT COUNT(*) FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'device_table' AND COLUMN_NAME = 'seen');
SET @sql := IF(@exists = 0,
    'ALTER TABLE device_table ADD seen DATETIME DEFAULT NULL',
    'SELECT "seen already there"');
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @exists := (SELECT COUNT(*) FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'device_table' AND COLUMN_NAME = 'opens');
SET @sql := IF(@exists = 0,
    'ALTER TABLE device_table ADD opens INT NOT NULL DEFAULT 1',
    'SELECT "opens already there"');
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

-- Counting a day of activity walks this column, so it should not walk the table.
SET @exists := (SELECT COUNT(*) FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'device_table' AND INDEX_NAME = 'device_seen_idx');
SET @sql := IF(@exists = 0,
    'CREATE INDEX device_seen_idx ON device_table (seen)',
    'SELECT "index already there"');
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

-- Reels: when one was last watched. views is a running total and says nothing
-- about when, so the panel could not tell a reel watched all week from one
-- watched once a year ago.
SET @exists := (SELECT COUNT(*) FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'reel_table' AND COLUMN_NAME = 'lastview');
SET @sql := IF(@exists = 0,
    'ALTER TABLE reel_table ADD lastview DATETIME DEFAULT NULL',
    'SELECT "lastview already there"');
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @exists := (SELECT COUNT(*) FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'reel_table' AND INDEX_NAME = 'reel_lastview_idx');
SET @sql := IF(@exists = 0,
    'CREATE INDEX reel_lastview_idx ON reel_table (lastview)',
    'SELECT "index already there"');
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;
