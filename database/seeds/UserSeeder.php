<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->delete();
        $adminRole = Role::whereName('administrator')->first();
        $userRole = Role::whereName('user')->first();

        $user = User::create(array(
            'first_name'    => 'Manfred',
            'last_name'     => 'Walder',
            'email'         => 'walder.manfred@gmail.com',
            'password'      => Hash::make('vald1234')
        ));
        $user->assignRole($adminRole);

        $user = User::create(array(
            'first_name'    => 'Jane',
            'last_name'     => 'Doe',
            'email'         => 'user@user.com',
            'password'      => Hash::make('user')
        ));
        $user->assignRole($userRole);
    }
}
