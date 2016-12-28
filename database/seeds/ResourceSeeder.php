<?php

use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = [
            [
                'name'=>'demo_RWD',
                'description' => 'resource which can have read write delete'
            ],
            [
                'name'=>'demo_RW',
                'description' => 'resource which can have read write'
            ],
            [
                'name'=>'demo_RD',
                'description' => 'resource which can have read delete'
            ],
            [
                'name'=>'demo_WD',
                'description' => 'resource which can have write delete'
            ],
            [
                'name'=>'demo_R',
                'description' => 'resource which can have read'
            ],
            [
                'name'=>'demo_W',
                'description' => 'resource which can have write'
            ],
            [
                'name'=>'demo_D',
                'description' => 'resource which can have delete'
            ]
        ];

        foreach($rows as $row){
            \App\Resource::create($row);
        }
    }
}
