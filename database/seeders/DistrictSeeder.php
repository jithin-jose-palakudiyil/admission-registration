<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('district')->get()->count() == 0){
            $tasks =  [
                        [
                            'name'  =>  'Thiruvananathapuram', 'slug'  =>  'thiruvananathapuram',
                        ],
                        [
                            'name'  =>  'Kollam', 'slug'    =>  'kollam',
                        ],                      
                        [
                            'name'  =>  'Alappuzha', 'slug'   =>  'alappuzha',
                        ],
                        [
                            'name'  =>  'Pathanamthitta','slug'     =>  'pathanamthitta',
                        ],
                        [
                            'name'  =>  'Kottayam', 'slug'   =>  'kottayam',
                        ],
                        [
                            'name'  =>  'Idukki', 'slug'    =>  'idukki',
                        ],
                        [
                            'name'  =>  'Ernakulam', 'slug'    =>  'ernakulam',
                        ],              
                        [
                            'name'  =>  'Thrissur', 'slug'    =>  'thrissur',
                        ],              
                        [
                            'name'  =>  'Palakkad', 'slug'    =>  'palakkad',
                        ],              
                        [
                            'name'  =>  'Malappuram', 'slug'    =>  'malappuram',
                        ],
                        [
                            'name'  =>  'Kozhikode', 'slug'    =>  'kozhikode',
                        ],
                        [
                            'name'  =>  'Wayanad', 'slug'    =>  'wayanad',
                        ],
                        [
                            'name'  =>  'Kannur', 'slug'    =>  'kannur',
                        ],
                        [
                            'name'  =>  'Kasargode', 'slug'    =>  'Kasargode',
                        ],
                       ];
            
            DB::table('district')->insert($tasks);
        }
    }
}
