<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1467988917.
 * Generated on 2016-07-08 16:41:57 by snake
 */
class PropelMigration_1467988917
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

ALTER TABLE `subject`

  CHANGE `address` `address` VARCHAR(255),

  CHANGE `zip` `zip` VARCHAR(20),

  CHANGE `city` `city` VARCHAR(100),

  CHANGE `province` `province` VARCHAR(100),

  CHANGE `country` `country` VARCHAR(100),

  CHANGE `phone` `phone` VARCHAR(100);

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

ALTER TABLE `subject`

  CHANGE `address` `address` VARCHAR(255) NOT NULL,

  CHANGE `zip` `zip` VARCHAR(20) NOT NULL,

  CHANGE `city` `city` VARCHAR(100) NOT NULL,

  CHANGE `province` `province` VARCHAR(100) NOT NULL,

  CHANGE `country` `country` VARCHAR(100) NOT NULL,

  CHANGE `phone` `phone` VARCHAR(100) NOT NULL;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}