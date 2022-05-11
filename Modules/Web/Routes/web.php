<?php

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

define("web_prefix", "/");
define("web_guard", "web");


Route::group([ 'middleware' => 'preventBackHistory','prefix' => web_prefix], function()
{
    Route::get('/', 'WebController@index')->name('loginView');
    Route::post('/login-store', 'LoginController@store')->name('loginStore');
    
    Route::get('/register', 'RegisterController@index')->name('RegisterView'); 
    Route::get('/register/resend-otp/', 'RegisterController@otp_resend')->name('otp_resend'); 
    Route::post('/register-store', 'RegisterController@store')->name('RegisterStore');

    Route::get('/forgot', 'ResetPasswordController@index')->name('forgot'); 
    Route::any('/forgot-send-otp', 'ResetPasswordController@SendOtp')->name('forgot_send_otp');
    Route::get('/forgot/otp', 'ResetPasswordController@OtpIndex')->name('forgot_otp');
    Route::any('/forgot-otp-verify/{user_id}', 'ResetPasswordController@forgotOtpVerify')->name('forgotOtpVerify');
    Route::get('/reset', 'ResetPasswordController@ResetView')->name('resetView');
    Route::post('/update/password/', 'ResetPasswordController@UpdatePassword')->name('UpdatePassword');
    Route::get('/reset/otp-resend/', 'ResetPasswordController@otp_resend')->name('otp_resend_reset');



    
    
        /* logged users opertaions */
        Route::group(['middleware' =>  'web_auth:'.web_guard], function()
        {
            Route::get('/register/otp', 'OtpController@index')->name('register_otp'); 
            Route::post('/register/otp/verify', 'OtpController@verify')->name('OtpVerify');
            Route::get('/logout', 'LoginController@Logout')->name('logout');

            Route::post('/store-personal-information', 'PersonalInfoController@store')->name('personal_info_store'); 
            Route::post('/store-courses-category', 'CoursesCategoryController@store')->name('courses_category_step_store'); 
            Route::post('/store-courses-colleges', 'CoursesCollegesController@store')->name('courses_colleges_step_store'); 
            Route::post('/store-accademic', 'AcademicsController@store')->name('accademic_step_store'); 
            Route::get('/courses-colleges/{courses_category_array}', 'CoursesCollegesController@index')->name('courses_colleges_step'); 
            
            
            Route::group(['middleware' => [ 'check_registration'] ], function()
            {
        
            Route::get('/personal-information', 'PersonalInfoController@index')->name('personal_info'); 
            
            Route::get('/courses-category', 'CoursesCategoryController@index')->name('courses_category_step'); 
            
            
            Route::get('/accademic', 'AcademicsController@index')->name('courses_accademic_step');
            
            
//            Route::post('/store-courses-colleges', 'CoursesCollegesController@store')->name('courses_colleges_step_store'); 

                
                
                Route::get('/dashboard', 'DashboardController@index')->name('dashboard_web'); 
                // Route::get('/dashboard/quiz', 'QuizController@index')->name('quiz_list_web'); 
                Route::get('/dashboard/start-quiz/introduction/{encrypted_quiz_id}/', function ($encrypted_quiz_id, \Illuminate\Http\Request $request) {

                    $quiz = null;
                    $error = null;
                    $page_title = null;
                    try{
                        $quiz = \Modules\Web\Entities\Quiz::where('id', \Crypt::decryptString($encrypted_quiz_id))->first();
                        if(!$quiz){
                            $request->session()->flash('flash-error-message', 'Quiz not found !');
                            return redirect()->back();
                        }
                        $page_title = 'MGM - '.$quiz->name;

                        //check if exam not fresh
                        if(isset($quiz->exam_type) && $quiz->exam_type!='fresh'):
                            // if(isset($quiz->exams)):
                                $user_created = (\Illuminate\Support\Carbon::parse(\Auth::guard(web_guard)->user()->created_at)->format('Y-m-d'));
                                $date_after = (\Illuminate\Support\Carbon::parse($quiz->date_users_reg_re_exam)->format('Y-m-d'));
                                $quiz_status = 1;
                                if($quiz->exams_status == 2): $quiz_status = 0; endif;
                                $exams = isset($quiz->exams) ? json_decode($quiz->exams) : [];
                                $allowed_users = [];
                                foreach ($exams as $examKey => $examValue) {
                                    $UserExamExist = \Modules\Web\Entities\UserExam::where('user_id', \Auth::guard(web_guard)->user()->id)->where('quiz_id', $examValue)->where('quiz_status', $quiz_status)->first();
                                    if($UserExamExist!=null) {
                                        array_push($allowed_users, $UserExamExist->user_id);
                                    }
                                }

                                $user_attended_exist = \Modules\Web\Entities\UserExam::where('user_id', \Auth::guard(web_guard)->user()->id)->where('quiz_id', '!=', $quiz->id)->first();
                                if($user_attended_exist==null && $quiz->is_need_new_users == 1 && isset($quiz->date_users_reg_re_exam)):
                                    if($user_created>=$date_after == false):                                    
                                        $request->session()->flash('flash-error-message', 'Sorry! you are not authorized to attend this exam');
                                        return redirect()->back();
                                    endif;
                                else:
                                    if(in_array(\Auth::guard(web_guard)->user()->id, $allowed_users)==false):
                                        $request->session()->flash('flash-error-message', 'Sorry! you are not authorized to attend this exam');
                                        return redirect()->back();
                                    endif;
                                endif;

 
            
                            // endif;
                        endif;


                        $UserExamFinished = \Modules\Web\Entities\UserExam::where('user_id', \Auth::guard(web_guard)->user()->id)->where('quiz_id', $quiz->id)->where('quiz_status', 1)->first();
                        $UserExamFinishedMode = \Modules\Web\Entities\UserExam::where('user_id', \Auth::guard(web_guard)->user()->id)->where('quiz_id', $quiz->id)->where('quiz_status', 3)->first();
                        if($UserExamFinished || $UserExamFinishedMode){
                            $request->session()->flash('flash-success-message', 'Scholarship exam is already completed by you !');
                            return redirect()->back();
                        }
                        $UserExam = \Modules\Web\Entities\UserExam::where('user_id', \Auth::guard(web_guard)->user()->id)->where('quiz_id', $quiz->id)->first();
                        $data = [
                            'quiz_id' => $quiz->id,
                            'quiz_status' => 0,
                            'react_route_name' => 'intro',
                            'user_id' => \Auth::guard(web_guard)->user()->id
                        ];
                        if($UserExam):
                            $UserExam->update($data);
                        else:
                            if($quiz->status!=1):
                                $request->session()->flash('flash-error-message', 'Scholarship exam not found !');
                                return redirect()->back();
                            else:
                                \Modules\Web\Entities\UserExam::create($data);
                            endif;
                        endif;
                    }catch(Exception $ex){$error = $ex->getMessage();}
                    if($error == null):
                        return view('web::dashboard.quiz.start_quiz', compact('quiz', 'encrypted_quiz_id', 'page_title'));
                    else:
                        $request->session()->flash('flash-error-message', $error);
                        return redirect()->back();
                    endif;

                  
                  })->where('encrypted_quiz_id', '.*')->name('quiz_get_web');


                  Route::get('/dashboard/start-quiz/exam/{encrypted_quiz_id}/', function ($encrypted_quiz_id, \Illuminate\Http\Request $request) {

                    $quiz = null;
                    $error = null;
                    $page_title = null;
                    try{
                        $quiz = \Modules\Web\Entities\Quiz::where('id', \Crypt::decryptString($encrypted_quiz_id))->first();
                        if(!$quiz){
                            $request->session()->flash('flash-error-message', 'Quiz not found !');
                            return redirect()->back();
                        }
                        //check if exam not fresh
                        if(isset($quiz->exam_type) && $quiz->exam_type!='fresh'):
                            // if(isset($quiz->exams)):
                                $user_created = (\Illuminate\Support\Carbon::parse(\Auth::guard(web_guard)->user()->created_at)->format('Y-m-d'));
                                $date_after = (\Illuminate\Support\Carbon::parse($quiz->date_users_reg_re_exam)->format('Y-m-d'));
                                $quiz_status = 1;
                                if($quiz->exams_status == 2): $quiz_status = 0; endif;
                                $exams = isset($quiz->exams) ? json_decode($quiz->exams) : [];
                                $allowed_users = [];
                                foreach ($exams as $examKey => $examValue) {
                                    $UserExamExist = \Modules\Web\Entities\UserExam::where('user_id', \Auth::guard(web_guard)->user()->id)->where('quiz_id', $examValue)->where('quiz_status', $quiz_status)->first();
                                    if($UserExamExist!=null) {
                                        array_push($allowed_users, $UserExamExist->user_id);
                                    }
                                }

                                $user_attended_exist = \Modules\Web\Entities\UserExam::where('user_id', \Auth::guard(web_guard)->user()->id)->where('quiz_id', '!=', $quiz->id)->first();
                                if($user_attended_exist==null && $quiz->is_need_new_users == 1 && isset($quiz->date_users_reg_re_exam)):
                                    if($user_created>=$date_after == false):                                    
                                        $request->session()->flash('flash-error-message', 'Sorry! you are not authorized to attend this exam');
                                        return redirect()->back();
                                    endif;
                                else:
                                    if(in_array(\Auth::guard(web_guard)->user()->id, $allowed_users)==false):
                                        $request->session()->flash('flash-error-message', 'Sorry! you are not authorized to attend this exam');
                                        return redirect()->back();
                                    endif;
                                endif;
            
                            // endif;
                        endif;

                        $UserExamFinished = \Modules\Web\Entities\UserExam::where('user_id', \Auth::guard(web_guard)->user()->id)->where('quiz_id', $quiz->id)->where('quiz_status', 1)->first();
                        $UserExamFinishedMode = \Modules\Web\Entities\UserExam::where('user_id', \Auth::guard(web_guard)->user()->id)->where('quiz_id', $quiz->id)->where('quiz_status', 3)->first();
                        if($UserExamFinished || $UserExamFinishedMode){
                            $request->session()->flash('flash-success-message', 'Scholarship exam is already completed by you !');
                            return redirect()->route('dashboard_web');
                        }
                        $page_title = 'MGM - '.$quiz->name;
                    }catch(Exception $ex){$error = $ex->getMessage();}
                    if($error == null):
                        return view('web::dashboard.quiz.start_quiz', compact('quiz', 'encrypted_quiz_id', 'page_title'));
                    else:
                        $request->session()->flash('flash-error-message', $error);
                        return redirect()->back();
                    endif;

                  
                  })->where('encrypted_quiz_id', '.*')->name('quiz_get_web_exam');


                  
                  //API
                    Route::get('/start-quiz/{quiz_id}', 'QuizController@StartQuizApi')->name('start_quiz_api'); 
                    Route::get('/get_quiz_question_answers/{quiz_id}', 'QuizController@GetQuizQuestionAnswersApi')->name('get_quiz_question_answers_web_api'); 
                    Route::post('/store_exam_data/{quiz_id}', 'QuizController@StoreQuizApi')->name('store_quiz_api'); 
                    Route::get('/preview_quiz/{quiz_id}', 'QuizController@PreviewQuizApi')->name('preview_quiz_api'); 
                    Route::get('/submit_mode_quiz/{quiz_id}', 'QuizController@SubmitModeQuizApi')->name('submit_mode_quiz_api'); 
                    Route::get('/submit_quiz/{quiz_id}', 'QuizController@SubmitQuizApi')->name('submit_quiz_api'); 
                    Route::get('/exam-start-time-get', 'QuizController@GetExamStartTime')->name('get_exam_start_time');
                    Route::get('/get-exam-end-time', 'QuizController@GetExamEndTime')->name('get_exam_end_time');


                    // Route::get('/start-quiz/{quiz_id}', 'QuizController@StartQuizApi')->name('start_quiz_api'); 

                Route::get('/documents', 'DocumentsController@index')->name('document_info'); 
                Route::post('/documents-save', 'DocumentsController@update')->name('document_update'); 
            
            });  
        });
    });
// Route::group([ 'middleware' => 'step_check'], function()
// {
// });
