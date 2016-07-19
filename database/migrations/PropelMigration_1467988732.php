<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1467988732.
 * Generated on 2016-07-08 16:38:52 by snake
 */
class PropelMigration_1467988732
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

  ADD `id_subject` INTEGER NOT NULL AFTER `email_confirmed`;

CREATE INDEX `user_subject_idx` ON `user` (`id_subject`);

ALTER TABLE `user` ADD CONSTRAINT `user_subject_fk`
    FOREIGN KEY (`id_subject`)
    REFERENCES `subject` (`id`)
    ON UPDATE CASCADE
    ON DELETE CASCADE;

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

ALTER TABLE `user` DROP FOREIGN KEY `user_subject_fk`;

DROP INDEX `user_subject_idx` ON `user`;

ALTER TABLE `user`

  DROP `id_subject`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}