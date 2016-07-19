<?php

namespace App\Models;

use App\Models\Base\Variable as BaseVariable;

/**
 * Skeleton subclass for representing a row from the 'variable' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Variable extends BaseVariable
{

	/**
	 * Torna l'oggetto al tag e gruppo corrispondente se esiste
	 *
	 * @param $name
	 * @param string $group
	 * @param $default
	 * @return string
	 */
	public static function getTagValue($name , $default = "", $group = "generic") {
		$ret = VariableQuery::create()
			->filterByGroup($group)
			->filterByName($name)
			->filterByEnabled(1)
			->findOne();

		if($ret instanceof Variable)
			return $ret->getValue();
		else
			return $default;
	}

}
