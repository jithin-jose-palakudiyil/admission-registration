<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class collegesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('colleges')->get()->count() == 0){
            $tasks =  [
                           [
                               'name'      =>  'Kilimanoor, trivandrum',
                               'slug'     =>  'kilimanoor-trivandrum',
                                'status'   => '1'
                           ],
                           [
                            'name'      =>  'Pampakuda, Ernakulam',
                            'slug'     =>  'pampakuda-ernakulam',
                             'status'   => '1'
                        ],                      [
                            'name'      =>  'Pilathara, kannur',
                            'slug'     =>  'pilathara-kannur',
                             'status'   => '1'
                        ],
                       ];
            
            DB::table('colleges')->insert($tasks);
        }
    }
}
