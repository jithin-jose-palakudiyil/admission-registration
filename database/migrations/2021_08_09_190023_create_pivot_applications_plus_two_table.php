<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotApplicationsPlusTwoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivot_applications_plus_two', function (Blueprint $table) {
            $table->increments('id');
            $table->foreign('new_applications_id')->references('id')->on('new_applications')->onDelete('cascade');
            $table->integer('new_applications_id')->unsigned();
            $table->string('subject',255)->nullable(false); 
            $table->string('mark_obtained',255)->nullable(false); 
            $table->string('maximum_marks',255)->nullable(false); 
            $table->string('grade',255)->nullable(false); 
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
        Schema::dropIfExists('pivot_applications_plus_two');
    }
}
