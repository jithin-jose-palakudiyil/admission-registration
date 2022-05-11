<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserExamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_exam', function (Blueprint $table) {
            $table->increments('id'); 

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('user_id')->unsigned();

            $table->foreign('quiz_id')->references('id')->on('quiz')->onDelete('cascade');
            $table->integer('quiz_id')->unsigned();

            $table->string('current_question_id',255)->nullable();  

            $table->tinyInteger('quiz_status')->default(0)->comment('0-progress, 1-completed, 2-preview');
            
            $table->string('react_route_name',255)->nullable();  
            
            $table->string('page_no',255)->nullable();  

            $table->json('question_array')->nullable(); 
            
            $table->string('total_questions',255)->nullable();
            $table->string('total_true_answer',255)->nullable();

            $table->timestamps();

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
        Schema::dropIfExists('user_exam');
    }
}
