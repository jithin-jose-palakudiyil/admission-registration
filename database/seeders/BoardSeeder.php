<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('board')->get()->count() == 0){
            $tasks =  [
                           [
                               'name'      =>  'HSE/State',
                               'slug'     =>  'hse-state',
                           ],
                           [
                            'name'      =>  'CBSE',
                            'slug'     =>  'cbse',
                        ],                      [
                            'name'      =>  'VHSE',
                            'slug'     =>  'vhse',
                        ],
                        [
                            'name'      =>  'Other',
                            'slug'     =>  'other',
                        ],
                       ];
            
            DB::table('board')->insert($tasks);
        }
    }
}
