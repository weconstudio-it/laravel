<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1468243578.
 * Generated on 2016-07-11 15:26:18 by snake
 */
class PropelMigration_1468243578
{
    public $comment = '';

    public function preUp($manager)
    {
        // add the pre-migration code here
    }

    public function postUp($manager)
    {
        // add the post-migration code here
    }

    public function preDown($manager)
    {
        // add the pre-migration code here
    }

    public function postDown($manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `user`

  ADD `id_language` INTEGER AFTER `id_subject`,

  ADD `id_currency` INTEGER AFTER `id_language`;

CREATE INDEX `user_language_idx` ON `user` (`id_language`);

CREATE INDEX `user_currency_idx` ON `user` (`id_currency`);

ALTER TABLE `user` ADD CONSTRAINT `user_language_fk`
    FOREIGN KEY (`id_language`)
    REFERENCES `language` (`id`);

ALTER TABLE `user` ADD CONSTRAINT `user_currency_fk`
    FOREIGN KEY (`id_currency`)
    REFERENCES `currency` (`id`);

CREATE TABLE `language`
(
    `iso639_1` VARCHAR(2),
    `i18n` VARCHAR(10),
    `code` VARCHAR(10),
    `description` VARCHAR(20),
    `active` TINYINT(1) DEFAULT 1,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `currency`
(
    `symbol` VARCHAR(3) NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `short_name` VARCHAR(20) NOT NULL,
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `currency_name` (`name`)
) ENGINE=InnoDB;

CREATE TABLE `currencies_rate_validity`
(
    `id_currency` INTEGER NOT NULL,
    `start` DATE NOT NULL,
    `end` DATE NOT NULL,
    `value` DECIMAL(10,2) NOT NULL,
    `active` TINYINT(1) NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (`id`),
    INDEX `fi_rencies_rate_validity_currency` (`id_currency`),
    CONSTRAINT `currencies_rate_validity_currency`
        FOREIGN KEY (`id_currency`)
        REFERENCES `currency` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `language`;

DROP TABLE IF EXISTS `currency`;

DROP TABLE IF EXISTS `currencies_rate_validity`;

ALTER TABLE `user` DROP FOREIGN KEY `user_language_fk`;

ALTER TABLE `user` DROP FOREIGN KEY `user_currency_fk`;

DROP INDEX `user_language_idx` ON `user`;

DROP INDEX `user_currency_idx` ON `user`;

ALTER TABLE `user`

  DROP `id_language`,

  DROP `id_currency`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}