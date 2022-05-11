<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password',255)->nullable(false);

            $table->string('otp',255)->nullable(); 
            $table->timestamp('otp_created_at')->nullable();
            $table->timestamp('otp_updated_at')->nullable();
            $table->tinyInteger('is_otp_sent')->nullable();
            $table->tinyInteger('is_otp_verified')->nullable();


            $table->string('gender',255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->text('address')->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('district',255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('pincode',255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('date_of_birth',255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('caste_category',255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('caste_category_other',255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('mobile',255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('whatsapp',255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('parent_name')->nullable();
            $table->string('parent_contact')->nullable();
            $table->string('class_completed',255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('last_studied',255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('board',255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('board_other',255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('annual_income',255)->collation('utf8mb4_unicode_ci')->nullable();

            $table->rememberToken();

            
            $table->string('reset_otp',255)->nullable(); 
            $table->timestamp('reset_otp_created_at')->nullable();
            $table->timestamp('reset_otp_updated_at')->nullable();

            $table->string('reset_token', 120)->unique()->nullable()->default(null);
            $table->timestamp('reset_token_created_at')->nullable();
            $table->timestamp('reset_token_updated_at')->nullable();

            $table->string('current_step')->comment('step_1, step_2, step_3, step_4, step_5')->default('step_1')->nullable();

            $table->string('tenth_board',255)->nullable();
            $table->string('tenth_passing_year',255)->nullable();
            $table->string('tenth_register_number',255)->nullable();
            $table->string('tenth_marks',255)->nullable();
            $table->string('tenth_mark_list',255)->nullable();
            
            $table->string('plus_two_board',255)->nullable(); 
            $table->string('plus_two_passing_year',255)->nullable();
            $table->string('plus_two_register_number',255)->nullable();
            $table->string('plus_two_marks',255)->nullable();
            $table->string('plus_two_stream',255)->nullable(); 
            $table->string('mark_list_plus_two',255)->nullable();
            
            
            $table->string('entrance_exam',255)->nullable();
            $table->string('scholarship_exam',255)->nullable();
            
            $table->string('entrance_name',255)->nullable();
            $table->string('entrance_rank',255)->nullable();
            $table->string('entrance_result_waiting',255)->nullable();
            $table->string('entrance_name_1',255)->nullable();
            $table->string('entrance_rank_1',255)->nullable();
            $table->string('entrance_result_waiting_1',255)->nullable();
            $table->string('let_exam',255)->nullable();
            $table->string('quota',255)->nullable();
            
            
           
            
            ////ALTER TABLE `users` ADD `entrance_result_waiting` VARCHAR(225) NULL DEFAULT NULL AFTER `entrance_rank`;
            ////ALTER TABLE `users` ADD `plus_two_stream` VARCHAR(225) NULL DEFAULT NULL AFTER `plus_two_register_number`;
            ////ALTER TABLE `users` ADD `scholarship_exam` VARCHAR(225) NULL DEFAULT NULL AFTER `entrance_result_waiting`;
            ////ALTER TABLE `users` ADD `entrance_name_1` VARCHAR(225) NULL DEFAULT NULL AFTER `entrance_result_waiting`, ADD `entrance_rank_1` VARCHAR(225) NULL DEFAULT NULL AFTER `entrance_name_1`, ADD `entrance_result_waiting_1` VARCHAR(225) NULL DEFAULT NULL AFTER `entrance_rank_1`;
            ////ALTER TABLE `users` ADD `let_exam` VARCHAR(225) NULL DEFAULT NULL AFTER `pcb_m`;
            ////ALTER TABLE `users` ADD `quota` VARCHAR(225) NULL DEFAULT NULL AFTER `email_verified_at`;
            
            ////ALTER TABLE `colleges` ADD `username` VARCHAR(225) NULL AFTER `name`, ADD UNIQUE `username` (`username`);
            //ALTER TABLE `colleges` ADD `password` VARCHAR(225) NOT NULL AFTER `username`;
            
            $table->string('pcm',255)->nullable();
            $table->string('pcb_m',255)->nullable();
        
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
            $table->softDeletesTz(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
