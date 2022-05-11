<?php

namespace Modules\Web\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \Modules\Web\Entities\Quiz;
use \Modules\Web\Entities\QuizQuestions;
use \Modules\Admin\Entities\Settings;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */



    public function index()
    {
        $page_title = 'MGM - Dashboard';
        $active = 'dashboard';
        $quiz_active = null;
        $Settings = null;
        $previous_exam = null;
        $is_allow = null;
        $previous_quiz = null;
        $Settings = Settings::find(1);
        $quiz = Quiz::where('open_or_close', 1)->first();
        if ($quiz!=null):
            $UserExam = null;
            $UserExam = \Modules\Web\Entities\UserExam::where('user_id', \Auth::guard(web_guard)->user()->id)->where('quiz_id', $quiz->id)->first();
            if($UserExam==null){
                $quiz_questions_exist = QuizQuestions::where('quiz_id', $quiz->id)->where('status', 1)->first();
            }else{
                $quiz_questions_exist = QuizQuestions::where('quiz_id', $quiz->id)->first();
            }
            if($quiz_questions_exist!=null){
                $quiz_active = $quiz;
            }

            $previous_exam = \Modules\Web\Entities\UserExam::where('user_id', \Auth::guard(web_guard)->user()->id)->orderBy('id', 'DESC')->first();
            if($previous_exam):
                $previous_quiz = Quiz::find($previous_exam->quiz_id);    
            endif;
            // dd($previous_exam,$previous_quiz);
            // dd($quiz_active);

            if(isset($quiz_active->exam_type) && $quiz_active->exam_type!='fresh'):
                // if(isset($quiz_active->exams)):
                    $user_created = (\Illuminate\Support\Carbon::parse(\Auth::guard(web_guard)->user()->created_at)->format('Y-m-d'));
                    $date_after = (\Illuminate\Support\Carbon::parse($quiz_active->date_users_reg_re_exam)->format('Y-m-d'));
                    $quiz_status = 1;
                    if($quiz_active->exams_status == 2): $quiz_status = 0; endif;
                    $exams = isset($quiz_active->exams) ? json_decode($quiz_active->exams) : [];
                    $allowed_users = [];
                    $user_attended_exist = \Modules\Web\Entities\UserExam::where('user_id', \Auth::guard(web_guard)->user()->id)->where('quiz_id', '!=', $quiz_active->id)->first();
                    foreach ($exams as $examKey => $examValue) {
                        $UserExamExist = \Modules\Web\Entities\UserExam::where('user_id', \Auth::guard(web_guard)->user()->id)->where('quiz_id', $examValue)->where('quiz_status', $quiz_status)->first();
                        if($UserExamExist!=null) {
                            array_push($allowed_users, $UserExamExist->user_id);
                        }
                    } 
                    if(in_array(\Auth::guard(web_guard)->user()->id, $allowed_users)):
                        $is_allow = true;
                    endif;

                    
                        // if(in_array(\Auth::guard(web_guard)->user()->id, $allowed_users)==true):
                        //     dd('no time needed !', \Auth::guard(web_guard)->user()->id);
                        // else:
                        //     if($user_attended_exist==null && $quiz_active->is_need_new_users == 1 && isset($quiz_active->date_users_reg_re_exam)):
                        //         if($user_created>=$date_after):
                        //             dd("can attend !");
                        //         else:
                        //             dd("cannot attend !");
                        //         endif;
                        //     else:
                        //         dd("you are not authorized !");
                        //     endif;
                        // endif;

                    // endif;
                endif;

        endif;
        return view('web::dashboard.index', compact('page_title', 'quiz_active', 'Settings', 'active', 'previous_exam', 'previous_quiz',  'is_allow'));
    }


    // public function index()
    // {
    //     $page_title = 'MGM - Dashboard';
    //     $active = 'dashboard';
    //     $quiz_all = [];
    //     $Settings = null;
    //     $Settings = Settings::find(1);
    //     $quizzes = Quiz::all();
    //     foreach ($quizzes as $key => $value){
    //         $UserExam = null;
    //         $UserExam = \Modules\Web\Entities\UserExam::where('user_id', \Auth::guard(web_guard)->user()->id)->where('quiz_id', $value->id)->first();
    //         if($UserExam==null){
    //             $quiz_questions_exist = QuizQuestions::where('quiz_id', $value->id)->where('status', 1)->first();
    //         }else{
    //             $quiz_questions_exist = QuizQuestions::where('quiz_id', $value->id)->first();
    //         }
    //         if($quiz_questions_exist!=null){
    //             array_push($quiz_all, $value);
    //         }
    //     }
    //     return view('web::dashboard.index', compact('page_title', 'quiz_all', 'Settings', 'active'));
    // }

   
}
