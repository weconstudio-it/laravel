<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1467987189.
 * Generated on 2016-07-08 16:13:09 by snake
 */
class PropelMigration_1467987189
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

  DROP `customer_type`,

  DROP `tax_number`,

  DROP `vat`,

  DROP `company_type`,

  DROP `company_name`,

  DROP `cf`;

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

  ADD `customer_type` INTEGER NOT NULL AFTER `last_name`,

  ADD `tax_number` VARCHAR(50) AFTER `customer_type`,

  ADD `vat` VARCHAR(50) AFTER `tax_number`,

  ADD `company_type` INTEGER AFTER `vat`,

  ADD `company_name` VARCHAR(255) AFTER `company_type`,

  ADD `cf` VARCHAR(255) AFTER `company_name`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}