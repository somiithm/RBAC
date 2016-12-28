<?php

use Illuminate\Database\Seeder;
use \App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * create 4 roles
         * one with all read access, one with all write access, one with delete access and one admin
         */

        $resources = \App\Resource::all();
        $admin = new Role();
        $admin->name = 'Admin';
        $admin->description = 'admin with all access';
        $admin->save();
        foreach($resources as $resource){
            $admin->resources()->attach($resource,['actions'=>json_encode(['*'])]);
        }

        $readUser = new Role();
        $readUser->name = 'Reader';
        $readUser->description = 'Read access for all resources';
        $readUser->save();
        foreach($resources as $resource){
            $readUser->resources()->attach($resource,['actions'=>json_encode(['READ'])]);
        }

        $writeUser = new Role();
        $writeUser->name = 'Writer';
        $writeUser->description = 'Write access for all resources';
        $writeUser->save();
        foreach($resources as $resource){
            $writeUser->resources()->attach($resource,['actions'=>json_encode(['WRITE'])]);
        }

        $deleteUser = new Role();
        $deleteUser->name = 'Deleter';
        $deleteUser->description = 'Delete access for all resources';
        $deleteUser->save();
        foreach($resources as $resource){
            $deleteUser->resources()->attach($resource,['actions'=>json_encode(['DELETE'])]);
        }

        $rwUser = new Role();
        $rwUser->name = 'ReaderWriter';
        $rwUser->description = 'Read and Write Access for all resources';
        $rwUser->save();
        foreach($resources as $resource){
            $rwUser->resources()->attach($resource,['actions'=>json_encode(['READ','WRITE'])]);
        }
    }
}
