<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotAssignCollegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivot_assign_colleges', function (Blueprint $table) {
            $table->increments('id');
            $table->foreign('college_id')->references('id')->on('colleges')->onDelete('cascade');
            $table->integer('college_id')->unsigned();
            $table->foreign('courses_category_id')->references('id')->on('courses_category')->onDelete('cascade');
            $table->integer('courses_category_id')->unsigned();
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
        Schema::dropIfExists('pivot_assign_colleges');
    }
}
