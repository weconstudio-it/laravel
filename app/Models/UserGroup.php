<?php

namespace App\Models;

use App\Models\Base\UserGroup as BaseUserGroup;

/**
 * Skeleton subclass for representing a row from the 'user_group' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class UserGroup extends BaseUserGroup
{
	const LEVEL_USER = 100;
	const LEVEL_MANAGER = 500;
	const LEVEL_ADMIN = 999;
}
