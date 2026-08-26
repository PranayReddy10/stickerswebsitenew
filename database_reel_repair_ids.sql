-- ---------------------------------------------------------------------------
-- Repair reel_table.id on an install where every reel has id = 0.
--
-- A copied database can lose PRIMARY KEY / AUTO_INCREMENT on the id column, and
-- then every insert writes 0. Doctrine keys entities by id, so rows sharing one
-- id hydrate to a single object repeated - which is why the panel and the app
-- show the same reel several times - and deleting one runs
-- DELETE ... WHERE id = 0, which takes every row with it.
--
-- SAFE TO RUN MORE THAN ONCE. Back the database up first anyway; this renumbers
-- rows. Run the whole file top to bottom in one go.
-- ---------------------------------------------------------------------------

-- 1. What the table looks like now. `auto_increment` in EXTRA and a PRIMARY row
--    in the second result mean this install is already fine.
SELECT COLUMN_NAME, COLUMN_TYPE, EXTRA
  FROM information_schema.COLUMNS
 WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'reel_table' AND COLUMN_NAME = 'id';

SELECT INDEX_NAME, COLUMN_NAME
  FROM information_schema.STATISTICS
 WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'reel_table';

-- 2. Likes pointing at a reel id that is about to change cannot be matched up
--    again, so drop the ones aimed at the broken id.
DELETE FROM `reel_like_table` WHERE `reel_id` = 0;

-- 3. Give every reel its own id, oldest first, so the feed keeps its order.
SET @row := 0;
UPDATE `reel_table` SET `id` = (@row := @row + 1) ORDER BY `created`, `objectkey`;

-- 4. Put the primary key back, if it is missing.
SET @havePk := (SELECT COUNT(*) FROM information_schema.STATISTICS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'reel_table'
                   AND INDEX_NAME = 'PRIMARY');
SET @ddl := IF(@havePk > 0,
               'SELECT 1',
               'ALTER TABLE `reel_table` ADD PRIMARY KEY (`id`)');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

-- 5. And make the column hand out the next id by itself.
SET @haveAi := (SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'reel_table'
                   AND COLUMN_NAME = 'id'
                   AND EXTRA LIKE '%auto_increment%');
SET @ddl := IF(@haveAi > 0,
               'SELECT 1',
               'ALTER TABLE `reel_table` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

-- 6. The like table is usually copied the same way, so check it too.
SET @havePk := (SELECT COUNT(*) FROM information_schema.STATISTICS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'reel_like_table'
                   AND INDEX_NAME = 'PRIMARY');
SET @ddl := IF(@havePk > 0,
               'SELECT 1',
               'ALTER TABLE `reel_like_table` ADD PRIMARY KEY (`id`)');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

SET @haveAi := (SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'reel_like_table'
                   AND COLUMN_NAME = 'id'
                   AND EXTRA LIKE '%auto_increment%');
SET @ddl := IF(@haveAi > 0,
               'SELECT 1',
               'ALTER TABLE `reel_like_table` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

-- 7. Prove it: every reel should now have its own id, and the next insert
--    should get one of its own.
SELECT `id`, `user_id`, `type`, `objectkey`, `created` FROM `reel_table` ORDER BY `id`;
SELECT COLUMN_NAME, EXTRA FROM information_schema.COLUMNS
 WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'reel_table' AND COLUMN_NAME = 'id';
