<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colleges', function (Blueprint $table) {

            $table->increments('id');  
            $table->string('name',255)->nullable(false); 
            $table->string('slug',255)->unique()->nullable(false);
            $table->string('username')->unique()->nullable(true);
            $table->string('password',255)->nullable(true);
            $table->text('application_heading')->nullable(true); 
            $table->tinyInteger('status')->default(0)->comment('0-InActive, 1-active');
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
        Schema::dropIfExists('colleges');
    }
}
