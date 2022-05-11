<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_applications', function (Blueprint $table) {
            $table->increments('id');    
            $table->foreign('form_id')->references('id')->on('forms');
            $table->integer('form_id')->unsigned();
            
            $table->foreign('college_id')->references('id')->on('colleges')->onDelete('cascade');
            $table->integer('college_id')->unsigned();
            
              
            $table->string('name',255)->nullable(false);  
            $table->string('email',255)->nullable(false); 
            $table->string('mobile',255)->nullable(false); 
            $table->string('photo',255)->nullable(false); 
            $table->string('date_of_birth',255)->nullable(false); 
            $table->string('age',255)->nullable(false); 
            $table->string('gender',255)->nullable(false); 
            $table->string('nationality',255)->nullable(false); 
            $table->string('religion',255)->nullable(false); 
            $table->string('community',255)->nullable(false); 
            $table->string('category',255)->nullable(false);
            $table->string('blood_group',255)->nullable(false);
            $table->string('aadhar_number',255)->nullable(false); 
            $table->tinyInteger('p_address_for_communication')->default(0)->comment('1-Yes, 0-No'); 
            $table->text('permanent_address')->nullable(false);
            $table->text('address_communication')->nullable(true);
            $table->string('signature_applicant',255)->nullable(false);
            $table->string('quota',255)->nullable(true);
            
            
            $table->string('father_name',255)->nullable(true); 
            $table->string('father_occupation',255)->nullable(true);
            $table->string('father_mobile',255)->nullable(true);
            $table->string('mother_name',255)->nullable(true); 
            $table->string('mother_occupation',255)->nullable(true);
            $table->string('mother_mobile',255)->nullable(true);
            $table->string('annual_family_income',255)->nullable(true);
            $table->string('guardian_name',255)->nullable(true);
            $table->string('guardian_relation',255)->nullable(true);
            $table->string('guardian_mobile',255)->nullable(true);
            $table->string('signature_parent',255)->nullable(false);
            
            $table->string('last_institution',255)->nullable(true);
            $table->string('name_university',255)->nullable(true);
            $table->string('last_board_study',255)->nullable(true);
            $table->string('register_no',255)->nullable(true);
            $table->string('month_year_passing',255)->nullable(true);
            $table->string('grand_total',255)->nullable(true);
            $table->string('total_percentage',255)->nullable(true);
            $table->string('pcm_total',255)->nullable(true);
            $table->string('pcm_percentage',255)->nullable(true);
            $table->string('plus_two_mark_list',255)->nullable(true);
            $table->string('diploma_mark_list',255)->nullable(true);
            $table->string('sslc_mark_list',255)->nullable(true);
            
            $table->string('entrance_register_number',255)->nullable(true);
            $table->string('entrance_rank',255)->nullable(true);
            $table->string('paper_I_figures',255)->nullable(true);
            $table->string('paper_I_words',255)->nullable(true);
            $table->string('paper_II_figures',255)->nullable(true);
            $table->string('paper_II_words',255)->nullable(true);
            $table->string('total_figures',255)->nullable(true);
            $table->string('total_words',255)->nullable(true);
            $table->string('name_of_sponsor',255)->nullable(true);
            $table->string('occupation_address',255)->nullable(true);
            
            $table->foreign('courses_category_id')->references('id')->on('courses_category');
            $table->integer('courses_category_id')->unsigned();
            
            $table->foreign('course_1')->references('id')->on('courses');
            $table->integer('course_1')->unsigned();
            
            $table->foreign('course_2')->references('id')->on('courses');
            $table->integer('course_2')->nullable(true)->unsigned();
            
            $table->foreign('course_3')->references('id')->on('courses');
            $table->integer('course_3')->nullable(true)->unsigned(); 
            
            $table->string('I_agree',255)->nullable(true);
           
            
            $table->string('diploma_mark',255)->nullable(true);
            $table->string('diploma_percentage',255)->nullable(true);
            $table->string('plus2_mark',255)->nullable(true);
            $table->string('sslc_mark',255)->nullable(true);
            
           $table->string('sslc_register_no',255)->nullable(true);
           $table->string('sslc_month_year_passing',255)->nullable(true);
           $table->string('sslc_total_percentage',255)->nullable(true);
           $table->string('sslc_pcm_percentage',255)->nullable(true);
           $table->string('sslc_board',255)->nullable(true);
           
            
            $table->string('btech_register_no',255)->nullable(true);
            $table->string('btech_month_year_passing',255)->nullable(true);
            $table->string('btech_mark_list',255)->nullable(true);
            $table->string('cgpa',255)->nullable(true);
            $table->string('plus_two_percentage',255)->nullable(true);
            $table->string('sslc_percentage',255)->nullable(true);
            $table->string('gate_qualified',255)->nullable(true);
            $table->string('gate_rank',255)->nullable(true);
           
            $table->text('place')->nullable(true);
            
            
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
        Schema::dropIfExists('new_applications');
    }
}
