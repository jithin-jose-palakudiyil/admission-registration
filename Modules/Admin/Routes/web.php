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

define("admin_prefix", "admin");
define("admin_guard", "admin");




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

Route::group([ 'middleware' => 'preventBackHistory','prefix' => admin_prefix], function()
{
    Route::get('/', 'AuthController@index');
    Route::any('/login', 'AuthController@LoginAction')->name('admin_login');
    /* logged admin user opertaions */
    Route::group(['middleware' =>  'admin_auth:admin'], function()
    {

        Route::get('/dashboard', 'DashboardController@index')->name('admin_dashboard');
        Route::get('/logout', 'AuthController@logout')->name('admin-logout');
         
        /* ************************************************************************** */
        /* ************************************ colleges **************************** */ 
        /* ************************************************************************** */ 
        Route::get('all-colleges-list', 'CollegesController@AllColleges' )->name('colleges_list'); 
        Route::bind('colleges', function ($value, $route) {return Modules\Admin\Entities\Colleges::find($value); }); 
        Route::resource( '/colleges', 'CollegesController',
                        [ 
                            'names' => [
                                        'index'   => 'colleges',
                                        'create'  => 'colleges.create', 
                                        'store'   => 'colleges.store', 
                                        'edit'    => 'colleges.edit',
                                        'update'  => 'colleges.update',
                                        'destroy' => 'colleges.destroy' 
                                       ],
                        ]
        ); 
        
        Route::get('colleges/assign-category/{id}', 'AssignCategoryController@index' )->name('assign_category_list'); 
        Route::post('colleges/assign-category-update/{id}', 'AssignCategoryController@update' )->name('assign_category_update'); 
        
        /* ************************************************************************** */
        /* ************************************ Courses ***************************** */ 
        /* ************************************************************************** */ 
        
        Route::get('all-courses-list', 'CoursesController@AllCourses' )->name('courses_list'); 
        Route::bind('courses', function ($value, $route) {return Modules\Admin\Entities\Courses::find($value); }); 
        Route::resource( '/courses', 'CoursesController',
                        [ 
                            'names' => [
                                        'index'   => 'courses',
                                        'create'  => 'courses.create', 
                                        'store'   => 'courses.store', 
                                        'edit'    => 'courses.edit',
                                        'update'  => 'courses.update',
                                        'destroy' => 'courses.destroy' 
                                       ],
                        ]
        ); 
        
        Route::get('courses/assign-category-college/{id}', 'AssignCategoryCollegeController@index' )->name('assign_category_college_list'); 
        Route::post('courses/assign-category-college-update/{id}', 'AssignCategoryCollegeController@update' )->name('assign_category_college_update'); 
        
        /* ************************************************************************** */
        /* ************************************ Courses ***************************** */ 
        /* ************************************************************************** */ 
        
        Route::get('all-category-list', 'CategoryController@AllCategory' )->name('category_list'); 
        Route::bind('category', function ($value, $route) {return Modules\Admin\Entities\CoursesCategory::find($value); }); 
        Route::resource( '/category', 'CategoryController',
                        [ 
                            'names' => [
                                        'index'   => 'category',
                                        'create'  => 'category.create', 
                                        'store'   => 'category.store', 
                                        'edit'    => 'category.edit',
                                        'update'  => 'category.update',
                                        'destroy' => 'category.destroy' 
                                       ],
                        ]
        );


        /* ************************************************************************** */
        /* ************************************ Users ***************************** */ 
        /* ************************************************************************** */ 
        
        Route::get('all-users', 'UserController@AllUsers' )->name('users_list'); 
        Route::bind('users', function ($value, $route) {return Modules\Admin\Entities\User::find($value); }); 
        Route::resource( '/users', 'UserController',
                        [ 
                            'names' => [
                                        'index'   => 'users',
                                        'destroy' => 'users.destroy' ,
                                       ],
                        ]
        );
        
        Route::get('/users/{id}/show', 'UserController@show' )->name('users.show'); 
        
        
        /* ************************************************************************** */
        /* ************************************ Quiz ******************************** */ 
        /* ************************************************************************** */ 
//        Route::get('all-quiz-list', 'QuizController@AllQuiz' )->name('quiz_list');
//        Route::get('/quiz/GetExams', 'QuizController@GetExams' );
//        Route::get('/quiz/open-exam/{quiz}', 'QuizController@OpenExams' );
//        
//        Route::get('/quiz/close/{quiz}', 'QuizController@close_quiz' )->name('close_quiz'); 
//        Route::bind('quiz', function ($value, $route) {return Modules\Admin\Entities\Quiz::find($value); }); 
//        Route::resource( '/quiz', 'QuizController',
//                        [ 
//                            'names' => [
//                                        'index'   => 'quiz',
//                                        'create'  => 'quiz.create', 
//                                        'store'   => 'quiz.store', 
//                                        'edit'    => 'quiz.edit',
//                                        'update'  => 'quiz.update',
//                                        'destroy' => 'quiz.destroy' 
//                                       ],
//                        ]
//        ); 
         
        /* ************************************************************************** */
        /* ****************************** ResultPublish ***************************** */ 
        /* ************************************************************************** */ 
//        Route::get('/quiz/result-publish/{quiz}', 'ResultPublishController@index' )->name('result_publish'); 
        
        
        /* ************************************************************************** */
        /* ************************************ Courses ***************************** */ 
        /* ************************************************************************** */ 
        
//        Route::get('all-quiz-questions-list', 'QuizQuestionsController@AllQuizQuestions' )->name('quiz_questions_list'); 
//        Route::bind('quiz-questions', function ($value, $route) {return Modules\Admin\Entities\QuizQuestions::find($value); }); 
//        Route::resource( '/quiz-questions', 'QuizQuestionsController',
//                        [ 
//                            'names' => [
//                                        'index'   => 'quiz-questions',
//                                        'create'  => 'quiz-questions.create', 
//                                        'edit'    => 'quiz-questions.edit',
//                                        'destroy' => 'quiz-questions.destroy' 
//                                       ],
//                        ]
//        );
//        Route::post( '/quiz-questions/store', 'QuizQuestionsController@store')->name('quiz-questions.store');
//        Route::post( '/quiz-questions/{quiz_question}/update', 'QuizQuestionsController@update')->name('quiz-questions.update');
//        Route::post( '/quiz-answers/{quiz_question}/store-update', 'QuizQuestionsController@AnswerStoreUpate')->name('quiz-answers.store-update');
//        Route::post( '/quiz-answers/{quiz_question}/store-update', 'QuizQuestionsController@AnswerStoreUpate')->name('quiz-answers.store-update');
//        Route::delete( '/quiz-answers/{quiz_question}/destroy', 'QuizQuestionsController@AnswerDelete')->name('quiz-answers.destroy');
//


        
        /* ************************************************************************** */
        /* ******************************* College Category ************************* */ 
        /* ************************************************************************** */ 
        
        Route::get('all-college-category-list', 'CollegeCategoryController@AllCollegeCategory' )->name('college_category_list'); 
        Route::bind('college-category', function ($value, $route) {return Modules\Admin\Entities\CollegeCategory::find($value); }); 
        Route::resource( '/college-category', 'CollegeCategoryController',
                        [ 
                            'names' => [
                                        'index'   => 'college-category',
                                        'create'  => 'college-category.create', 
                                        'store'   => 'college-category.store', 
                                        'edit'    => 'college-category.edit',
                                        'update'  => 'college-category.update',
                                        'destroy' => 'college-category.destroy' 
                                       ],
                        ]
        );
        
        Route::get('assign-college-category/{CollegeCategory}', 'CollegeCategoryController@assign_view' )->name('assign_college_category_list'); 
        Route::post('assign-college-category-update/{CollegeCategory}', 'CollegeCategoryController@assign_update' )->name('assign_college_category_update'); 
        
        
        /* ************************************************************************** */
        /* ******************************* User quiz ************************* */ 
        /* ************************************************************************** */ 

//        Route::get('all-user-quiz-list', 'DashboardController@AllUsersQuiz' )->name('user_quiz.list'); 
//        Route::any('all-user-quiz-list-filtered', 'DashboardController@AllUsersQuizFiltered' )->name('user_quiz.list-filtered'); 
//        Route::get('users-quiz', 'DashboardController@index' )->name('user_quiz.index'); 
//        Route::get('users-quiz/{id}/show', 'DashboardController@show' )->name('user_quiz.show');      
//        
        
        /* ********************************************************************* */
        /* **************************** Settings ******************************* */ 
        /* ********************************************************************* */ 
        
        Route::get('/settings', 'SettingsController@index')->name('admin_settings');
        Route::post('/update-quiz-notification', 'SettingsController@updateQuizNotification')->name('update-quiz-notification');
//        Route::post('/update-notification', 'SettingsController@updateNotification')->name('update-notification');
//        Route::post('/update-quiz-settings', 'SettingsController@updateQuizSettings')->name('update-quiz-settings');
        
        
        
        
        
        
        
        
        /* ************************************************************************** */
        /* ************************************ Courses ***************************** */ 
        /* ************************************************************************** */ 
        
        Route::get('all-board-list', 'BoardController@AllBoard' )->name('board_list'); 
        Route::bind('board', function ($value, $route) {return Modules\Admin\Entities\Board::find($value); }); 
        Route::resource( '/board', 'BoardController',
                        [ 
                            'names' => [
                                        'index'   => 'board',
                                        'create'  => 'board.create', 
                                        'store'   => 'board.store', 
                                        'edit'    => 'board.edit',
                                        'update'  => 'board.update',
                                        'destroy' => 'board.destroy' 
                                       ],
                        ]
        ); 
        
        
//        Route::post('admin_document_update/{user}', 'DocumentsController@update' )->name('admin_document_update'); 
        
        
        
         /* ************************************************************************** */
        /* ************************************ Courses ***************************** */ 
        /* ************************************************************************** */ 
       
        Route::get('colleges/assign-forms/{college}', 'FormsController@assign_forms' ); 
        Route::post('colleges/assign-forms-store/{college}', 'FormsController@assign_forms_store' )->name('assign_forms_store'); 
        Route::get('all-forms-list', 'FormsController@AllForms' )->name('forms_list'); 
        Route::bind('forms', function ($value, $route) {return Modules\Admin\Entities\Forms::find($value); }); 
        Route::resource( '/forms', 'FormsController',
                        [ 
                            'names' => [
                                        'index'   => 'forms',
                                       ],
                        ]
        ); 
        
        
        
        
        
    });
});


/*
        |--------------------------------------------------------------------------
        | Download Web Routes
        |--------------------------------------------------------------------------
        */

            Route::group(['middleware' =>  'admin_auth:admin'], function()
            {
                Route::get('download-user-pdf/{id}', 'UserController@download_user_pdf')->name('download_user_pdf');
                Route::get('download-excel-clg/{id}', 'UserController@download_excel')->name('download_excel_clgs');
 
            });
 
        
//        Route::group([ 'middleware' => 'admin_auth:admin','prefix' => admin_prefix], function()
//        {
//            Route::get('download-users-excel', 'UserController@download_users_excel')->name('download_users_excel');
//            
//            Route::get('download-users-quiz-excel', 'DashboardController@download_users_quiz_excel')->name('download_users_quiz_excel');
//            Route::get('download-user-quiz-pdf/{id}', 'DashboardController@download_user_quiz_pdf')->name('download_user_quiz_pdf');
//            Route::get('download-filtered-user-quiz-excel/{exam_id}/{exam_status}/{document}', 'DashboardController@download_filtered_user_quiz_excel')->name('download_filtered_user_quiz_excel');
//
//            Route::get('download-result/{quiz}/', 'ResultPublishController@download_result' );      
//            Route::get('download-all-not-attended/', 'QuizController@not_attended_users' )->name('download-all-not-attended');      
//        
//            
//        });  
            
            

