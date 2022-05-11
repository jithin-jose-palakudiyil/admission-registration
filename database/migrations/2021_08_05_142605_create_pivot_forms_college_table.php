<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotFormsCollegeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivot_forms_college', function (Blueprint $table) {
            $table->increments('id');  
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
            $table->integer('form_id')->unsigned();
            $table->foreign('college_id')->references('id')->on('colleges')->onDelete('cascade');
            $table->integer('college_id')->unsigned();
            $table->string('forms_college_id')->unique();
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
        Schema::dropIfExists('pivot_forms_college');
    }
}
