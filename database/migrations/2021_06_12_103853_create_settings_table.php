<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('notification_exist_image',255)->nullable(true); 
            $table->string('notification_exist_text',255)->nullable(true); 
            $table->string('exam_start_time',255)->nullable(true); 
            $table->string('exam_end_time',255)->nullable(true); 
            $table->string('notification_not_exist_image',255)->nullable(true); 
            $table->string('notification_not_exist_text',255)->nullable(true); 
            $table->string('quiz_not_exist_image',255)->nullable(true); 
            $table->string('quiz_not_exist_text',255)->nullable(true); 
            $table->string('documents_image',255)->nullable(true); 
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
        Schema::dropIfExists('settings');
    }
}
