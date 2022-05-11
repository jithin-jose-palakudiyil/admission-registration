<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignCollegeCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_college_category', function (Blueprint $table) {
            $table->increments('id');
            $table->foreign('category_id')->references('id')->on('colleges')->onDelete('cascade');
            $table->integer('category_id')->unsigned();
            $table->foreign('course_category_id')->references('id')->on('courses_category')->onDelete('cascade');
            $table->integer('course_category_id')->unsigned();
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
        Schema::dropIfExists('assign_college_category');
    }
}
