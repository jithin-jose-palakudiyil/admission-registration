<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotUserCategoryCollegesCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivot_user_category_colleges_courses', function (Blueprint $table) {
            $table->increments('id'); 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('college_id')->references('id')->on('colleges')->onDelete('cascade');
            $table->integer('college_id')->unsigned();
            $table->foreign('courses_category_id')->references('id')->on('courses_category')->onDelete('cascade');
            $table->integer('courses_category_id')->unsigned();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->integer('course_id')->unsigned();
            $table->tinyInteger('preference')->comment('1,2,3')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pivot_user_category_colleges_courses');
    }
}
