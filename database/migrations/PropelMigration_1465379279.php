<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1465379279.
 * Generated on 2016-06-08 11:47:59 by snake
 */
class PropelMigration_1465379279
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

CREATE TABLE `user`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_user_group` INTEGER NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `username` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `remember_token` VARCHAR(100),
    `enabled` TINYINT(1) DEFAULT 0 NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `user_username_uq` (`username`),
    INDEX `user_user_group_idx` (`id_user_group`),
    CONSTRAINT `user_user_group_fk`
        FOREIGN KEY (`id_user_group`)
        REFERENCES `user_group` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `user_group`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `label` VARCHAR(45) NOT NULL,
    `level` INTEGER NOT NULL,
    `visible` TINYINT(1) DEFAULT 1 NOT NULL,
    `enabled` TINYINT(1) DEFAULT 1 NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `user_group_level_uq` (`level`)
) ENGINE=InnoDB;

CREATE TABLE `jobs`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `queue` VARCHAR(255) NOT NULL,
    `payload` LONGTEXT NOT NULL,
    `attempts` tinyint(3) unsigned NOT NULL,
    `reserved` tinyint(3) unsigned NOT NULL,
    `reserved_at` int(10) unsigned,
    `available_at` int(10) unsigned NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `jobs_queue_reserved_reserved_at_index` (`queue`, `reserved`, `reserved_at`)
) ENGINE=InnoDB;

CREATE TABLE `failed_jobs`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `connection` TEXT NOT NULL,
    `queue` TEXT NOT NULL,
    `payload` LONGTEXT NOT NULL,
    `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
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

DROP TABLE IF EXISTS `user`;

DROP TABLE IF EXISTS `user_group`;

DROP TABLE IF EXISTS `jobs`;

DROP TABLE IF EXISTS `failed_jobs`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}