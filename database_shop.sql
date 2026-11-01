-- The shop: whether it is on, whether the app shows a button, where it is, and
-- the key to read its products with.
--
-- The key is stored here and nowhere else. The app asks this server for products
-- and this server asks the shop, so the key never travels to a phone.
--
-- All nullable and the shop is off until switched on, so an install that runs
-- this and changes nothing behaves exactly as before.
--
-- Safe to run twice.

DROP PROCEDURE IF EXISTS add_shop_column;
DELIMITER //
CREATE PROCEDURE add_shop_column(IN colname VARCHAR(64), IN coltype VARCHAR(64))
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

CALL add_shop_column('shopenabled', 'VARCHAR(255)');
CALL add_shop_column('shopbutton', 'VARCHAR(255)');
CALL add_shop_column('shopname', 'VARCHAR(255)');
CALL add_shop_column('shopurl', 'VARCHAR(500)');
CALL add_shop_column('shopapiurl', 'VARCHAR(500)');
CALL add_shop_column('shopapikey', 'VARCHAR(500)');

DROP PROCEDURE add_shop_column;
