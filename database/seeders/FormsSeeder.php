<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \DB;
class FormsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       if(DB::table('forms')->get()->count() == 0){
            $tasks =  [
                        ['name'=>'B.Tech DEGREE', 'slug'=>'btech-regular'],
                        ['name'=>'B.Tech (Lateral Entry) DEGREE', 'slug'=>'btech-lateral-entry'],
                         
                        ['name'=>'Polytechnic Diploma', 'slug'=>'polytechnic-diploma-regular'],
                        ['name'=>'Polytechnic Diploma (Lateral Entry)', 'slug'=>'polytechnic-diploma-lateral-entry'],
                
                        ['name'=>'B. Pharm DEGREE', 'slug'=>'b-pharm-regular'],
                        ['name'=>'D. Pharm DEGREE', 'slug'=>'d-pharm-regular'],
                        
                       ];
            
            DB::table('forms')->insert($tasks);
        }
    }
}
