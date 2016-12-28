<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = \App\Role::where('name','Admin')->first();
        $readRole = \App\Role::where('name','Reader')->first();
        $writeRole = \App\Role::where('name','Writer')->first();
        $deleteRole = \App\Role::where('name','Deleter')->first();
        $rwRole = \App\Role::where('name','ReaderWriter')->first();

        $adminUser = \App\User::create(['name'=>'Admin','email'=>'admin@user.com','password'=>bcrypt('Admin')]);
        $adminUser->roles()->attach($adminRole);

        $readUser = \App\User::create(['name'=>'ReadUser','email'=>'read@user.com','password'=>bcrypt('ReadUser')]);
        $readUser->roles()->attach($readRole);

        $writeUser = \App\User::create(['name'=>'WriteUser','email'=>'write@user.com','password'=>bcrypt('WriteUser')]);
        $writeUser->roles()->attach($writeRole);

        $deleteUser = \App\User::create(['name'=>'DeleteUser','email'=>'delete@user.com','password'=>bcrypt('DeleteUser')]);
        $deleteUser->roles()->attach($deleteRole);

        $rwUser = \App\User::create(['name'=>'ReadWriteUser','email'=>'readwrite@user.com','password'=>bcrypt('ReadWriteUser')]);
        $rwUser->roles()->attach($rwRole);
    }
}
