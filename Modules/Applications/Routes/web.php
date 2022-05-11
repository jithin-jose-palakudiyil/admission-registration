<?php
/*
|--------------------------------------------------------------------------
| Constants variables
|--------------------------------------------------------------------------
|
| Here is where you can register Constants variables for your application. These
| variables are loaded by the application. Now create something great!
|
*/

define("application_prefix", "new-application");




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([ 'middleware' => 'preventBackHistory','prefix' => application_prefix], function()
{
//    Route::get('/', 'ApplicationsController@index')->name('application_index');
    Route::get('/{slug}/{forms_college_id}', 'ApplicationsController@index')->name('application_index');
    Route::get('get_courses_category_colleges', 'ApplicationsController@get_courses_category_colleges' )->name('get_courses_category_colleges'); 
    
    Route::post('/btech-regular-store/{forms_college_id}', 'ApplicationsController@btech_regular_store')->name('btech_regular_store');
    Route::post('/btech-lateral-store/{forms_college_id}', 'ApplicationsController@btech_lateral_store')->name('btech_lateral_store');
    Route::post('/polytechnic-diploma-regular/{forms_college_id}', 'ApplicationsController@polytechnic_regular_store')->name('polytechnic_regular_store');
    Route::post('/polytechnic-diploma-lateral/{forms_college_id}', 'ApplicationsController@polytechnic_lateral_store')->name('polytechnic_lateral_store');
    Route::post('/b-pharm-regular-store/{forms_college_id}', 'ApplicationsController@b_pharm_regular_store')->name('b_pharm_regular_store');
    Route::post('/d-pharm-regular-store/{forms_college_id}', 'ApplicationsController@d_pharm_regular_store')->name('d_pharm_regular_store');
    Route::post('/m-tech-store/{forms_college_id}', 'ApplicationsController@m_tech_store')->name('m_tech_store');
        
});

