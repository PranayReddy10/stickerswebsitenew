-- Subscriptions, as the app reports them.
--
-- Google Play knows who is paying. It does not know which of your users that is,
-- which device they use, or how many times they have subscribed before - this is
-- where those answers live. One row per purchase token: the app confirms it at
-- every launch, and the row is updated rather than added to.
--
-- Safe to run twice.

CREATE TABLE IF NOT EXISTS subscription_table (
    id             INT AUTO_INCREMENT NOT NULL,
    user_id        INT DEFAULT NULL,
    device         VARCHAR(191) DEFAULT NULL,
    product        VARCHAR(191) DEFAULT NULL,
    purchasetoken  LONGTEXT DEFAULT NULL,
    tokenhash      VARCHAR(40) DEFAULT NULL,
    orderid        VARCHAR(191) DEFAULT NULL,
    state          VARCHAR(32) NOT NULL,
    platform       VARCHAR(32) NOT NULL,
    renewing       TINYINT(1) NOT NULL,
    started        DATETIME DEFAULT NULL,
    created        DATETIME NOT NULL,
    updated        DATETIME NOT NULL,
    checks         INT NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY subscription_token_idx (tokenhash),
    KEY subscription_device_idx (device),
    KEY subscription_state_idx (state, updated),
    KEY subscription_user_idx (user_id),
    CONSTRAINT subscription_user_fk FOREIGN KEY (user_id)
        REFERENCES fos_user_table (id) ON DELETE SET NULL
) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
