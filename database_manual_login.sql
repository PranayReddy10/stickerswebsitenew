-- ---------------------------------------------------------------------------
-- Email and password accounts in the app.
--
-- Adds settings_table.manuallogin, the switch on the Settings page that decides
-- whether the app shows the email sign up and sign in form. Safe to run twice.
-- ---------------------------------------------------------------------------

SET @ddl := IF((SELECT COUNT(*) FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'settings_table'
                   AND COLUMN_NAME = 'manuallogin') > 0,
               'SELECT 1',
               'ALTER TABLE `settings_table` ADD COLUMN `manuallogin` varchar(255) DEFAULT NULL');
PREPARE s FROM @ddl; EXECUTE s; DEALLOCATE PREPARE s;

-- Off by default: an existing install keeps behaving exactly as it does today.
UPDATE `settings_table` SET `manuallogin` = COALESCE(`manuallogin`, 'FALSE');
