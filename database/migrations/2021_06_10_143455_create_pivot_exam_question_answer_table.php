<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotExamQuestionAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivot_exam_question_answer', function (Blueprint $table) {
            $table->increments('id'); 

            $table->foreign('exam_id')->references('id')->on('user_exam')->onDelete('cascade');
            $table->integer('exam_id')->unsigned();

            $table->foreign('quiz_question_id')->references('id')->on('quiz_questions')->onDelete('cascade');
            $table->integer('quiz_question_id')->unsigned()->nullable();

            $table->foreign('quiz_answer_id')->references('id')->on('quiz_answers')->onDelete('cascade');
            $table->integer('quiz_answer_id')->unsigned()->nullable();

            $table->tinyInteger('answered')->default(0)->comment('0-unanswered, 1-answered');

            $table->string('page_no',255)->nullable();  

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
        Schema::dropIfExists('pivot_exam_question_answer');
    }
}
