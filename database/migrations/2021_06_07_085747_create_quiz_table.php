<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz', function (Blueprint $table) {
            $table->increments('id');  
            $table->string('name',255)->nullable(false); 
            $table->string('image',255)->nullable(true); 
            $table->string('button_text',255)->nullable(false); 
            $table->tinyInteger('status')->default(0)->comment('0-InActive, 1-active');
            $table->tinyInteger('open_or_close')->default(1)->comment('1-open, 2-close');
            $table->tinyInteger('review_quiz')->default(0)->comment('0-disabled, 1-enabled');
            $table->string('video_id',255)->nullable(false); 
            $table->string('btn_show_status',255)->comment('fixed, timer')->nullable(false); 
            $table->string('time_of_btn',255)->nullable(); 
            $table->text('description')->nullable(false); 
            $table->text('exam_completed_description')->nullable(false);
            $table->string('exam_completed_image',255)->nullable(false);  
            $table->tinyInteger('exam_type')->comment('1-Completed,2-In Progress');
            $table->tinyInteger('is_need_new_users')->default(0)->comment('1-yes,0-no');
            $table->string('date_users_reg_re_exam',255)->nullable(); 
            $table->json('exams')->nullable(); 
            
            $table->tinyInteger('result_published')->default(2)->comment('1-Yes, 2-No,3-started publishing');
            $table->timestamp('published_at')->nullable();
            $table->string('total_users',255)->nullable();
            $table->Integer('progress')->nullable();
             
            
            
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
            $table->softDeletesTz();
            /*
ALTER TABLE `quiz` ADD `exam_type` VARCHAR(225) NULL DEFAULT NULL AFTER `exam_completed_image`, ADD `exams_status` TINYINT(4) NULL DEFAULT NULL COMMENT '1-Completed,2-In Progress' AFTER `exam_type`, ADD `is_need_new_users` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '1-yes,0-no' AFTER `exams_status`, ADD `date_users_reg_re_exam` VARCHAR(255) NULL DEFAULT NULL AFTER `is_need_new_users`, ADD `exams` JSON NULL DEFAULT NULL AFTER `date_users_reg_re_exam`;             */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz');
    }
}
