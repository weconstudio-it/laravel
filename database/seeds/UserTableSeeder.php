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
			['label' => 'Super Admin', 'level' => 999, 'visible' => 1, 'enabled' => 1],
			['label' => 'Admin', 'level' => 900, 'visible' => 1, 'enabled' => 1],
			['label' => 'Manager', 'level' => 500, 'visible' => 1, 'enabled' => 1],
			['label' => 'User', 'level' => 100, 'visible' => 1, 'enabled' => 1],
		];
		
		$subs = [
			['active' => 1, 'iso' => 'it_IT', 'first_name' => 'Admin', 'last_name' => 'Super'],
			['active' => 1, 'iso' => 'it_IT', 'first_name' => 'Admin', 'last_name' => ''],
			['active' => 1, 'iso' => 'it_IT', 'first_name' => 'Manager', 'last_name' => ''],
			['active' => 1, 'iso' => 'it_IT', 'first_name' => 'User', 'last_name' => ''],
		];

		$users = [
			['name' => 'SuperAdmin', 'email' => 'info@weconstudio.it', 'username' => 'superadmin', 'password' => bcrypt('superadmin'), 'enabled' => 1, 'email_confirmed' => 1],
			['name' => 'Admin', 'email' => 'info@weconstudio.it', 'username' => 'admin', 'password' => bcrypt('admin'), 'enabled' => 1, 'email_confirmed' => 1],
			['name' => 'Manager', 'email' => 'info@weconstudio.it', 'username' => 'manager', 'password' => bcrypt('manager'), 'enabled' => 1, 'email_confirmed' => 1],
			['name' => 'User', 'email' => 'info@weconstudio.it', 'username' => 'user', 'password' => bcrypt('user'), 'enabled' => 1, 'email_confirmed' => 1],
		];

		$gp = [];
		$sb = [];
		$i = 0;
		foreach ($groups as $group) {
			$userGroup = new \App\Models\UserGroup();
			$userGroup->fromArray($group);
			$userGroup->save();

			$gp[] = $userGroup->getId();
		}

		foreach ($subs as $sub) {
			$subject = new \App\Models\Subject();
			$subject->fromArray($sub);
			$subject->save();

			$sb[] = $subject->getId();
		}

		foreach ($users as $user) {
			$u = new \App\Models\User();
			$u->fromArray($user);
			$u->setIdSubject($sb[$i]);
			$u->setIdUserGroup($gp[$i++]);
			$u->save();
		}
    }
}
