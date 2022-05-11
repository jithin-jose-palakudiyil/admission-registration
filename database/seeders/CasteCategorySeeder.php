<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CasteCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('caste_category')->get()->count() == 0){
            $tasks =  [
                           [
                               'name'      =>  'General',
                               'slug'     =>  'general',
                           ],
                           [
                            'name'      =>  'OBC',
                            'slug'     =>  'obc',
                        ],                      [
                            'name'      =>  'SC/ST',
                            'slug'     =>  'sc-st',
                        ],
                        [
                        'name'      =>  'Other',
                        'slug'     =>  'other',
                        ],
                       ];
            
            DB::table('caste_category')->insert($tasks);
        }
    }
}
