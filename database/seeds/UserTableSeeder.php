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
		$userGroup = new \App\Models\UserGroup();
		$userGroup->setLabel('Admin');
		$userGroup->setLevel(10);
		$userGroup->setVisible(1);
		$userGroup->setEnabled(1);
		$userGroup->save();

		$user = new \App\Models\User();
        $user->setName('Admin');
        $user->setEmail('info@weconstudio.it');
        $user->setUsername('admin');
        $user->setPassword(bcrypt('admin'));
        $user->setEnabled(1);
		$user->setIdUserGroup($userGroup->getId());
        $user->save();
    }
}
