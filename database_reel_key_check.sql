-- ---------------------------------------------------------------------------
-- Are two reels sharing one file?
--
-- Two rows pointing at the same object key is what makes a new upload appear to
-- replace an older picture, makes several reels show the same image, and makes
-- deleting one take the picture from all of them.
--
-- 1. Look. Every row this returns is a file more than one reel is using.
-- ---------------------------------------------------------------------------
SELECT `objectkey`, COUNT(*) AS reels, GROUP_CONCAT(`id` ORDER BY `id`) AS reel_ids
  FROM `reel_table`
 GROUP BY `objectkey`
HAVING COUNT(*) > 1
 ORDER BY reels DESC;

-- 2. The ten most recent reels, to see whether new uploads get their own key.
SELECT `id`, `user_id`, `type`, `objectkey`, `thumbkey`, `created`
  FROM `reel_table`
 ORDER BY `id` DESC
 LIMIT 10;

-- ---------------------------------------------------------------------------
-- 3. Only once the first query returns nothing: stop it happening again at the
--    database level as well as in the controller. Skipped automatically while
--    duplicates remain, because the index cannot be created over them.
-- ---------------------------------------------------------------------------
SET @dupes := (SELECT COUNT(*) FROM (
    SELECT `objectkey` FROM `reel_table` GROUP BY `objectkey` HAVING COUNT(*) > 1
) d);
SET @have := (SELECT COUNT(*) FROM information_schema.STATISTICS
               WHERE TABLE_SCHEMA = DATABASE()
                 AND TABLE_NAME = 'reel_table'
                 AND INDEX_NAME = 'reel_objectkey_unique');
SET @ddl := IF(@dupes > 0 OR @have > 0,
               'SELECT 1',
               'ALTER TABLE `reel_table` ADD UNIQUE KEY `reel_objectkey_unique` (`objectkey`)');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;
