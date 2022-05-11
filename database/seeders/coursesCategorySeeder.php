<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class coursesCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('courses_category')->get()->count() == 0){
            $tasks =  [
                           [
                               'name'      =>  'Polytechnic',
                               'slug'     =>  'polytechnic',
                                'status'   => '1'
                           ],
                           [
                            'name'      =>  'B.pharm',
                            'slug'     =>  'b-pharm',
                             'status'   => '1'
                        ],                      [
                            'name'      =>  'D.Pharm',
                            'slug'     =>  'd-pharm',
                             'status'   => '1'
                        ],
                       ];
            
            DB::table('courses_category')->insert($tasks);
        }
    }
}
