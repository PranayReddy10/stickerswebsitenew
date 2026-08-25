-- ---------------------------------------------------------------------------
-- Reels: short vertical photo and video posts.
--
-- SAFE TO RUN MORE THAN ONCE. The tables are created only if missing, and the
-- settings column is added only if missing.
--
-- The media itself lives in DigitalOcean Spaces. Only the object keys are stored
-- here, so the bucket can be moved or put behind a CDN without touching the data.
-- ---------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `reel_table` (
  `id`        int(11)      NOT NULL AUTO_INCREMENT,
  `user_id`   int(11)      DEFAULT NULL,
  `type`      varchar(16)  NOT NULL DEFAULT 'video',
  `objectkey` varchar(500) NOT NULL,
  `thumbkey`  varchar(500) DEFAULT NULL,
  `caption`   longtext     DEFAULT NULL,
  `width`     int(11)      DEFAULT NULL,
  `height`    int(11)      DEFAULT NULL,
  `duration`  int(11)      DEFAULT NULL,
  `views`     int(11)      NOT NULL DEFAULT 0,
  `likes`     int(11)      NOT NULL DEFAULT 0,
  `enabled`   tinyint(1)   NOT NULL DEFAULT 1,
  `review`    tinyint(1)   NOT NULL DEFAULT 0,
  `created`   datetime     NOT NULL,
  PRIMARY KEY (`id`),
  KEY `reel_user_idx` (`user_id`),
  -- The feed orders by created DESC and filters on enabled/review, so this is
  -- the index that keeps it fast once there are a lot of reels.
  KEY `reel_feed_idx` (`enabled`, `review`, `created`),
  CONSTRAINT `fk_reel_user` FOREIGN KEY (`user_id`) REFERENCES `fos_user_table` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

CREATE TABLE IF NOT EXISTS `reel_like_table` (
  `id`      int(11)  NOT NULL AUTO_INCREMENT,
  `reel_id` int(11)  DEFAULT NULL,
  `user_id` int(11)  DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reel_user_unique` (`reel_id`, `user_id`),
  KEY `reel_like_user_idx` (`user_id`),
  CONSTRAINT `fk_reel_like_reel` FOREIGN KEY (`reel_id`) REFERENCES `reel_table` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_reel_like_user` FOREIGN KEY (`user_id`) REFERENCES `fos_user_table` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Whether reels uploaded from the app go live immediately or wait for review.
SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'reelsautopublish') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `reelsautopublish` varchar(255) DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

UPDATE `settings_table` SET `reelsautopublish` = COALESCE(`reelsautopublish`, 'FALSE');

-- Reels between two native ads in the Reels feed. Empty means "use nativeitem",
-- so an existing install keeps behaving the same until it is set.
SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'reelsnativeitem') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `reelsnativeitem` int DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;
