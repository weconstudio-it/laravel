<?php

namespace App\Models;

use App\Models\Base\User as BaseUser;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * Skeleton subclass for representing a row from the 'user' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class User extends BaseUser implements AuthenticatableContract, CanResetPasswordContract {
	
	use Authenticatable, CanResetPassword;
	
	/**
	 * Get the e-mail address where password reset links are sent.
	 *
	 * @return string
	 */
	public function getEmailForPasswordReset()
	{
		return $this->getEmail();
	}
	
	public function getAuthIdentifier()
	{
		return $this->id;
	}

	public function __toString() {
		return $this->getName();
	}
	
	/**
	 * Restituisce il livello dell'utente corrente
	 * @return int
	 */
	public function getLevel() {
		$group = $this->getUserGroup();
		
		if($group instanceof UserGroup) {
			return intval($group->getLevel());
		}
		
		return PHP_INT_MAX;
	}
}
