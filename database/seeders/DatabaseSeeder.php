<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if( $this->call(AdmiUsers::class))
        $this->command->info('Table courses category seeded!');  
         
        if( $this->call(coursesCategorySeeder::class))
        $this->command->info('Table courses category seeded!');  
        
        if( $this->call(coursesSeeder::class))
        $this->command->info('Table courses seeded!');  
        
        if( $this->call(collegesSeeder::class))
        $this->command->info('Table colleges seeded!');  

        if( $this->call(DistrictSeeder::class))
        $this->command->info('Table district seeded!');  

        if( $this->call(CasteCategorySeeder::class))
        $this->command->info('Table caste category seeded!'); 

        if( $this->call(ClassCompletedSeeder::class))
        $this->command->info('Table class completed seeded!');  

        if( $this->call(BoardSeeder::class))
        $this->command->info('Table Board seeded!');  
        
        if( $this->call(FormsSeeder::class))
        $this->command->info('Table Forms seeded!');  

    
    }
}
