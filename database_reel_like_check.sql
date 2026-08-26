-- ---------------------------------------------------------------------------
-- Why a like comes back 500 while the feed reads fine.
--
-- The insert works by hand, so the table is there; these check the parts
-- Doctrine needs that a hand written INSERT does not: the auto increment on the
-- id, and columns matching what the entity maps.
-- ---------------------------------------------------------------------------

-- 1. reel_like_table.id must be a primary key AND auto_increment. Without the
--    auto increment Doctrine inserts 0 every time and the second like collides.
SELECT COLUMN_NAME, COLUMN_TYPE, IS_NULLABLE, COLUMN_DEFAULT, EXTRA
  FROM information_schema.COLUMNS
 WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'reel_like_table';

SELECT INDEX_NAME, COLUMN_NAME, NON_UNIQUE
  FROM information_schema.STATISTICS
 WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'reel_like_table'
 ORDER BY INDEX_NAME, SEQ_IN_INDEX;

-- 2. The same for reel_table, which the like also updates.
SELECT COLUMN_NAME, COLUMN_TYPE, EXTRA
  FROM information_schema.COLUMNS
 WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'reel_table' AND COLUMN_NAME IN ('id','likes','views');

-- 3. Repair the like table's id if either piece is missing.
SET @havePk := (SELECT COUNT(*) FROM information_schema.STATISTICS
                 WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'reel_like_table'
                   AND INDEX_NAME = 'PRIMARY');
SET @ddl := IF(@havePk > 0, 'SELECT 1',
               'ALTER TABLE `reel_like_table` ADD PRIMARY KEY (`id`)');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

SET @haveAi := (SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'reel_like_table'
                   AND COLUMN_NAME = 'id' AND EXTRA LIKE '%auto_increment%');
SET @ddl := IF(@haveAi > 0, 'SELECT 1',
               'ALTER TABLE `reel_like_table` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

-- 4. Clear the test row so the app can like that reel again.
DELETE FROM `reel_like_table` WHERE `reel_id` = 4 AND `user_id` = 1;

-- 5. Prove the column is right now.
SELECT COLUMN_NAME, EXTRA FROM information_schema.COLUMNS
 WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'reel_like_table' AND COLUMN_NAME = 'id';
