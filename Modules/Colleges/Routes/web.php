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

define("colleges_prefix", "colleges");
define("colleges_guard", "colleges");




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
Route::group([ 'middleware' => 'preventBackHistory','prefix' => colleges_prefix], function()
{
    Route::get('/', 'AuthController@index');
    Route::any('/login', 'AuthController@LoginAction')->name('colleges_login');
    
    /* logged admin user opertaions */
    Route::group(['middleware' =>  'colleges_auth:'.colleges_guard], function()
    {
        Route::get('/dashboard', 'DashboardController@index')->name('colleges_dashboard');
        Route::get('/logout', 'AuthController@logout')->name('colleges-logout');
        Route::get('/colleges-users-list', 'UsersController@users_list')->name('colleges_users_list');
        Route::get('/users/{id}/show', 'UsersController@show' )->name('colleges_users_show'); 
        Route::get('applications', 'ApplicationsController@index' )->name('colleges_applications_index');  
        Route::get('all-applications-list', 'ApplicationsController@AllApplications' )->name('colleges_applications_list'); 
        Route::get('applications/{id}/show', 'ApplicationsController@show' )->name('colleges_applications_show'); 
        
    });
});

        /*|--------------------------------------------------------------------------
        | Download Web Routes
        |--------------------------------------------------------------------------
        */
        
        Route::group([ 'middleware' => 'colleges_auth:'.colleges_guard,'prefix' => colleges_prefix], function()
        {
            Route::get('download-pdf/{id}', 'ApplicationsController@download_pdf')->name('clg_download_pdf');
             Route::get('download-excel', 'ApplicationsController@download_excel')->name('clg_download_excel');
 
        });  
