-- Messages: say what each one is, so a reported pack, a reported user, a reported
-- reel and somebody writing in stop looking identical in the panel.
--
-- Two columns only. Filing the rows already in the table needs no SQL: the first
-- visit to the messages page reads the kind out of each old message and saves it.
--
-- Safe to run twice.

SET @exists := (SELECT COUNT(*) FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'support_table'
      AND COLUMN_NAME = 'kind');
SET @sql := IF(@exists = 0,
    'ALTER TABLE support_table ADD kind VARCHAR(32) DEFAULT NULL',
    'SELECT "kind already there"');
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @exists := (SELECT COUNT(*) FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'support_table'
      AND COLUMN_NAME = 'targetid');
SET @sql := IF(@exists = 0,
    'ALTER TABLE support_table ADD targetid INT DEFAULT NULL',
    'SELECT "targetid already there"');
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Reading the list is much quicker when the headings can be counted straight off
-- an index rather than by walking the table.
SET @exists := (SELECT COUNT(*) FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'support_table'
      AND INDEX_NAME = 'support_kind_idx');
SET @sql := IF(@exists = 0,
    'CREATE INDEX support_kind_idx ON support_table (kind)',
    'SELECT "index already there"');
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
