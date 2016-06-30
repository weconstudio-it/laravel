<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$groups = [
			['label' => 'SuperAdmin', 'level' => 999, 'visible' => 1, 'enabled' => 1],
			['label' => 'Admin', 'level' => 900, 'visible' => 1, 'enabled' => 1],
			['label' => 'Manager', 'level' => 500, 'visible' => 1, 'enabled' => 1],
			['label' => 'User', 'level' => 100, 'visible' => 1, 'enabled' => 1],
		];

		$users = [
			['name' => 'SuperAdmin', 'email' => 'info@weconstudio.it', 'username' => 'superadmin', 'password' => bcrypt('superadmin'), 'enabled' => 1],
			['name' => 'Admin', 'email' => 'info@weconstudio.it', 'username' => 'admin', 'password' => bcrypt('admin'), 'enabled' => 1],
			['name' => 'Manager', 'email' => 'info@weconstudio.it', 'username' => 'manager', 'password' => bcrypt('manager'), 'enabled' => 1],
			['name' => 'User', 'email' => 'info@weconstudio.it', 'username' => 'user', 'password' => bcrypt('user'), 'enabled' => 1],
		];

		$gp = [];
		$i = 0;
		foreach ($groups as $group) {
			$userGroup = new \App\Models\UserGroup();
			$userGroup->fromArray($group);
			$userGroup->save();

			$gp[] = $userGroup->getId();
		}

		foreach ($users as $user) {
			$u = new \App\Models\User();
			$u->fromArray($user);
			$u->setIdUserGroup($gp[$i++]);
			$u->save();
		}
    }
}
