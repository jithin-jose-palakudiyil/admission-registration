<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ClassCompletedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('class_completed')->get()->count() == 0){
            $tasks =  [
                           [
                               'name'      =>  '10th',
                               'slug'     =>  '10th',
                           ],
                           [
                            'name'      =>  '12th',
                            'slug'     =>  '12th',
                        ],                      [
                            'name'      =>  'Polytechnic Diploma',
                            'slug'     =>  'polytechnic-diploma',
                        ],
                        [
                        'name'      =>  'ITI',
                        'slug'     =>  'ITI',
                        ],
                       ];
            
            DB::table('class_completed')->insert($tasks);
        }
    }
}


