-- Your own ads: the last thing the app's waterfall tries, and the only one that
-- cannot fail to fill.
--
-- Two tables. One holds the creatives and their running totals; the other holds
-- a row per ad per day, which is what the panel's chart draws. A row per event
-- would be millions a month to answer a question nobody asks at that
-- resolution.
--
-- Safe to run twice.

CREATE TABLE IF NOT EXISTS house_ad_table (
    id           INT AUTO_INCREMENT NOT NULL,
    image_id     INT DEFAULT NULL,
    format       VARCHAR(32) NOT NULL,
    title        VARCHAR(120) DEFAULT NULL,
    body         VARCHAR(255) DEFAULT NULL,
    cta          VARCHAR(40) DEFAULT NULL,
    url          VARCHAR(500) DEFAULT NULL,
    enabled      TINYINT(1) NOT NULL DEFAULT 1,
    weight       INT NOT NULL DEFAULT 1,
    impressions  INT NOT NULL DEFAULT 0,
    clicks       INT NOT NULL DEFAULT 0,
    created      DATETIME NOT NULL,
    INDEX house_ad_format (format),
    INDEX house_ad_image (image_id),
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;

-- The unique key on (ad_id, day) is what makes the counting safe: the app's
-- reports are applied with INSERT ... ON DUPLICATE KEY UPDATE, so two phones
-- reporting the same second cannot each read zero and each write one. Without
-- this key that statement would quietly grow a row per report instead.
CREATE TABLE IF NOT EXISTS house_ad_stat_table (
    id           INT AUTO_INCREMENT NOT NULL,
    ad_id        INT NOT NULL,
    format       VARCHAR(32) NOT NULL,
    day          DATE NOT NULL,
    impressions  INT NOT NULL DEFAULT 0,
    clicks       INT NOT NULL DEFAULT 0,
    UNIQUE INDEX house_ad_day (ad_id, day),
    INDEX house_stat_day (day),
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;

-- Deleting an ad takes its day rows with it, so the totals on the list page and
-- the chart under them can never disagree.
DROP PROCEDURE IF EXISTS add_house_stat_fk;
DELIMITER //
CREATE PROCEDURE add_house_stat_fk()
BEGIN
    IF NOT EXISTS (SELECT 1 FROM information_schema.KEY_COLUMN_USAGE
        WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'house_ad_stat_table'
          AND COLUMN_NAME = 'ad_id' AND REFERENCED_TABLE_NAME IS NOT NULL) THEN
        ALTER TABLE house_ad_stat_table
            ADD CONSTRAINT FK_house_ad_stat_ad
            FOREIGN KEY (ad_id) REFERENCES house_ad_table (id) ON DELETE CASCADE;
    END IF;
END //
DELIMITER ;

CALL add_house_stat_fk();
DROP PROCEDURE add_house_stat_fk;
