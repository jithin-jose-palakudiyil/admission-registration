<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class coursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('courses')->get()->count() == 0){
            $tasks =  [
                           [
                               'name'      =>  'civil',
                               'slug'     =>  'covil',
                                'status'   => '1'
                           ],
                           [
                            'name'      =>  'Cse',
                            'slug'     =>  'cse',
                             'status'   => '1'
                        ],                      
                        [
                            'name'      =>  'Mech',
                            'slug'     =>  'mech',
                             'status'   => '1'
                        ],
                        [
                            'name'      =>  'Ece',
                            'slug'     =>  'ece',
                             'status'   => '1'
                        ],
                        [
                            'name'      =>  'Aero',
                            'slug'     =>  'aero',
                             'status'   => '1'
                        ],
                        [
                            'name'      =>  'EEE',
                            'slug'     =>  'eee',
                             'status'   => '1'
                        ],
                       ];
            
            DB::table('courses')->insert($tasks);
        }
    }
}
