<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        try{
            $this->call('ResourceSeeder');
            $this->call('RoleSeeder');
            $this->call('UserSeeder');
            DB::commit();
        } catch(\Exception $ex){
            DB::rollback();
            \Log::error($ex->getMessage());
        }
    }
}
