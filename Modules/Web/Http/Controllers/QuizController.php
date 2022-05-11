<?php

namespace Modules\Web\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Routing\Controller;
use \Modules\Web\Entities\Quiz;
use \Modules\Web\Entities\QuizQuestions;
use \Modules\Web\Entities\QuizAnswers;
use \Modules\Web\Entities\UserExam;
use \Modules\Web\Entities\PivotExamQA;
use \Modules\Admin\Entities\Settings;


class QuizController extends Controller
{

    public function index()
    {
        $page_title = 'MGM - Scholarship Exam';
        $active = 'quiz';
        $quiz_all = [];
        $Settings = null;
        $Settings = Settings::find(1);
        $quizzes = Quiz::all();
        foreach ($quizzes as $key => $value){
            $UserExam = null;
            $UserExam = \Modules\Web\Entities\UserExam::where('user_id', \Auth::guard(web_guard)->user()->id)->where('quiz_id', $value->id)->first();
            if($UserExam==null){
                $quiz_questions_exist = QuizQuestions::where('quiz_id', $value->id)->where('status', 1)->first();
            }else{
                $quiz_questions_exist = QuizQuestions::where('quiz_id', $value->id)->first();
            }
            if($quiz_questions_exist!=null){
                array_push($quiz_all, $value);
            }
        }

        return view('web::dashboard.quiz.index', compact('quiz_all', 'page_title', 'active', 'Settings'));
    }


    // public function GetQuiz($encrypted_quiz_id, Request $request)
    // {
    //     $quiz = null;
    //     $error = null;
    //     try{
    //         $quiz = Quiz::where('id', \Crypt::decryptString($quiz_id))->first();
    //         if(!$quiz){
    //             $request->session()->flash('flash-error-message', 'Quiz not found !');
    //             return redirect()->back();
    //         }
    //     }catch(Exception $ex){$error = $ex->getMessage();}
    //     if($error == null):
    //         return view('web::dashboard.quiz.start_quiz', compact('quiz', 'encrypted_quiz_id'));
    //     else:
    //         $request->session()->flash('flash-error-message', 'Sorry some error occured !');
    //         return redirect()->back();
    //     endif;
    //     // $page_title = 'MGM - '.$quiz->name;

    // }


    public function StartQuizApi($quiz_id){
        $quiz_id_encrypted = $quiz_id;
        $quiz_id=\Crypt::decryptString($quiz_id_encrypted);
        $error = null;
        try{
            $UserExam = UserExam::where('user_id', \Auth::guard(web_guard)->user()->id)->where('quiz_id', $quiz_id)->first();
            $data = [
                'quiz_id' => $UserExam->quiz_id,
                'quiz_status' => 0,
                'react_route_name' => 'exam',
                'user_id' => \Auth::guard(web_guard)->user()->id
            ];
            if($UserExam):
                $UserExam->update($data);
            else:
                return response()
                ->json(['status'=>false,  "message"=> "Quiz not found"], 404);
            endif;

        }catch(Exception $ex){$error = $ex->getMessage();}
        if($error == null):
            return response()
            ->json(['status'=>true, "message"=> "Successfully updated exam state"], 201);
        else:
            return response()
            ->json(['status'=>false, "message"=> $error], 500);
        endif;
    }


    public function GetQuizQuestionAnswersApi($quiz_id, Request $request)
    {
            $quiz_id_encrypted = $quiz_id;
            $quiz_id=\Crypt::decryptString($quiz_id_encrypted);
            $error = null;
            $currentPage = null;
            $question_answers = [];
            $quiz_status = null;
            $resultData = (object)null;
            try{
                $quiz = Quiz::where('id', $quiz_id)->first();
                $UserExam = UserExam::where('user_id', \Auth::guard(web_guard)->user()->id)->where('quiz_id', $quiz->id)->first();
                if(!$UserExam):
                    if($quiz->status!=1):
                        $request->session()->flash('flash-error-message', 'Scholarship exam not found !');
                        return response()
                        ->json(['status'=>false, "type"=>'redirect', "message"=> "Scholarship exam not found"], 404);
                    endif;
                endif;
                if($UserExam->status == 0 && $UserExam->react_route_name == 'exam'){
                    $currentPage = $UserExam->page_no;
                    $quiz_status = $UserExam->quiz_status;
                    $PivotExamQAall = PivotExamQA::where('exam_id', $UserExam->id)->get();
                    foreach ($PivotExamQAall as $key => $value){
                        $quiz_question_id = $value->quiz_question_id;
                        if($quiz_question_id!=null || $quiz_question_id!=''):
                         if($value->answered == 0){
                             $resultData->{$quiz_question_id} = (object)[
                                 'qid' => $value->quiz_question_id,
                                 'currentPage'=> $value->page_no,
                                 'answered'=> 0,
                             ];
                         }else{
                          if($value->answered == 1):
                              $resultData->{$quiz_question_id} = (object)[
                                  'qid' => $value->quiz_question_id,
                                  'currentPage'=> $value->page_no,
                                  'ans_id'=> $value->quiz_answer_id,
                                  'answered'=> $value->answered,
                              ];
                          else:
                              $resultData->{$quiz_question_id} = (object)[
                                  'qid' => $value->quiz_question_id,
                                  'currentPage'=> $value->page_no,
                              ];
                          endif;
          
                         }
                     endif;
                    }

                }

                $questions = [];
                $quizQuestionIds = [];
                $attendedData = $PivotExamQAall->pluck('quiz_question_id')->toArray();
                $questionAll = QuizQuestions::where('quiz_id', $quiz->id)->get()->pluck('id')->toArray();
                // dd($attendedData);
                if(isset($attendedData) && count($attendedData) > 0):
                    foreach ($attendedData as $attendedDatakey => $attendedDataValue){
                        if(in_array($attendedDataValue, $questionAll)==true):
                            array_push($quizQuestionIds, $attendedDataValue);
                        endif;
                    }
                endif;

                $questionsWithStatus = QuizQuestions::where('quiz_id', $quiz->id)->where('status', 1)->get()->pluck('id')->toArray();
                foreach ($questionsWithStatus as $qkey => $qvalue){
                    if(in_array($qvalue, $quizQuestionIds)==false){
                        array_push($quizQuestionIds, $qvalue);
                    }
                }

                foreach($quizQuestionIds as $quizQuestionIdskey => $quizQuestionIdsValue){
                    $value = QuizQuestions::where('id', $quizQuestionIdsValue)->first();
                    if($value!=null):
                        array_push($questions, $value);
                    endif;
                }


                foreach ($questions as $questionKey => $questionValue){
                    $answers = QuizAnswers::where('quiz_question_id', $questionValue->id)->get();
                    $questionValue["answers"] = $answers;
                    array_push($question_answers, $questionValue);
                }
            }catch(Exception $ex){$error = $ex->getMessage();}
            if($error == null):
                return response()
                ->json(['status'=>true, 'question_answers'=>$question_answers, 'current_page'=>$currentPage, 'attended'=>$resultData, 'quiz_status' =>$quiz_status, "message"=> "Successfully fetched question & answers"], 201);
            else:
                return response()
                ->json(['status'=>false, "message"=> $error], 500);
            endif;
    }


    public function StoreQuizApi(Request $request, $quiz_id){
        $quiz_id_encrypted = $quiz_id;
        $quiz_id=\Crypt::decryptString($quiz_id_encrypted);
        $pivotData = [];
        $ExamData = [];
        $error = null;
        $resultData = (object)null;
        try{
            $UserExam = UserExam::where('user_id', \Auth::guard(web_guard)->user()->id)->where('quiz_id', $quiz_id)->first();
            $ExamData = [
                'current_question_id' => $request->qid,
                'page_no' => $request->currentPage
            ];
            if($UserExam):
                $UserExam->update($ExamData);
                $PivotExamQA = PivotExamQA::where('exam_id', $UserExam->id)
                ->where('quiz_question_id', $UserExam->current_question_id)
                ->where('page_no', $UserExam->page_no)->first();
                if($request->exists('answered')):
                    if($request->answered == true):
                        $pivotData = [
                            'quiz_question_id' => $UserExam->current_question_id,
                            'exam_id' => $UserExam->id,
                            'page_no' => $UserExam->page_no,
                            'answered' => $request->answered,
                            'quiz_answer_id' => $request->ans_id
                        ];
                    else:
                        $pivotData = [
                            'quiz_question_id' => $UserExam->current_question_id,
                            'exam_id' => $UserExam->id,
                            'page_no' => $UserExam->page_no,
                            'answered' => $request->answered,
                            'quiz_answer_id' => null

                        ];
                    endif;
                else:
                    $pivotData = [
                        'quiz_question_id' => $UserExam->current_question_id,
                        'exam_id' => $UserExam->id,
                        'page_no' => $UserExam->page_no,
                        'answered' => 0,
                        'quiz_answer_id' => null
                    ];
                endif;
                if($PivotExamQA!=null):
                    $PivotExamQA->update($pivotData);
                else:
                    PivotExamQA::create($pivotData);
                endif;

            else:
                return response()
                ->json(['status'=>false,  "message"=> "Quiz not found"], 404);
            endif;
            $PivotExamQAall = PivotExamQA::where('exam_id', $UserExam->id)->get();
           foreach ($PivotExamQAall as $key => $value){
               $quiz_question_id = $value->quiz_question_id;
               if($quiz_question_id!=null || $quiz_question_id!=''):
                if($value->answered == 0){
                    $resultData->{$quiz_question_id} = (object)[
                        'qid' => $value->quiz_question_id,
                        'currentPage'=> $value->page_no,
                        'answered'=> 0,
                    ];
                }else{
                 if($value->answered == 1):
                     $resultData->{$quiz_question_id} = (object)[
                         'qid' => $value->quiz_question_id,
                         'currentPage'=> $value->page_no,
                         'ans_id'=> $value->quiz_answer_id,
                         'answered'=> $value->answered,
                     ];
                 else:
                     $resultData->{$quiz_question_id} = (object)[
                         'qid' => $value->quiz_question_id,
                         'currentPage'=> $value->page_no,
                     ];
                 endif;
 
                }
            endif;
           }

        }catch(Exception $ex){$error = $ex->getMessage();}
        if($error == null):
            return response()
            ->json(['status'=>true, "attended" => $resultData, "message"=> "Successfully fetched attended questions"], 201);
        else:
            return response()
            ->json(['status'=>false, "message"=> "Sorry! Something went wrong."], 500);
        endif;

    }



    public function PreviewQuizApi(Request $request, $quiz_id){
        
        $error = null;
        $quiz_id_encrypted = $quiz_id;
        $quiz_id=\Crypt::decryptString($quiz_id_encrypted);
        try{
            $UserExam = UserExam::where('user_id', \Auth::guard(web_guard)->user()->id)
            ->where('quiz_id', $quiz_id)->where('react_route_name', "exam")->first();
            if(!$UserExam){
                return response()
                ->json(['status'=>false, "message"=> "Sorry! Exam not found."], 404); 
            }
            // if($UserExam->quiz_status == 0):
                $UserExam->update(['quiz_status'=> 2]);
            // endif;
        }catch(Exception $ex){$error = $ex->getMessage();}

        if($error == null):
            return response()
            ->json(['status'=>true, "message"=> "Exam status updated successfully"], 201);
        else:
            return response()
            ->json(['status'=>false, "message"=> "Sorry! Something went wrong"], 500);
        endif;
    }


    public function SubmitModeQuizApi(Request $request, $quiz_id){
        
        $error = null;
        $quiz_id_encrypted = $quiz_id;
        $quiz_id=\Crypt::decryptString($quiz_id_encrypted);
        try{
            $UserExam = UserExam::where('user_id', \Auth::guard(web_guard)->user()->id)
            ->where('quiz_id', $quiz_id)->where('react_route_name', "exam")->first();
            if(!$UserExam){
                return response()
                ->json(['status'=>false, "message"=> "Sorry! Exam not found."], 404); 
            }
            // if($UserExam->quiz_status == 0):
                $UserExam->update(['quiz_status'=> 3]);
            // endif;
        }catch(Exception $ex){$error = $ex->getMessage();}

        if($error == null):
            return response()
            ->json(['status'=>true, "message"=> "Exam status updated successfully"], 201);
        else:
            return response()
            ->json(['status'=>false, "message"=> "Sorry! Something went wrong"], 500);
        endif;
    }


    public function SubmitQuizApi(Request $request, $quiz_id){
        
        $error = null;
        $quiz_id_encrypted = $quiz_id;
        $quiz_id=\Crypt::decryptString($quiz_id_encrypted);
        try{
            $UserExam = UserExam::where('user_id', \Auth::guard(web_guard)->user()->id)
            ->where('quiz_id', $quiz_id)->where('react_route_name', "exam")->first();
            if(!$UserExam){
                return response()
                ->json(['status'=>false, "message"=> "Sorry! Exam not found."], 404); 
            }
                $UserExam->update(['quiz_status'=> 1]);
        }catch(Exception $ex){$error = $ex->getMessage();}

        if($error == null):
            return response()
            ->json(['status'=>true, "message"=> "Submitted successfully"], 201);
        else:
            return response()
            ->json(['status'=>false, "message"=> "Sorry! Something went wrong"], 500);
        endif;
    }



    public function GetExamStartTime()
    {
        $error = null;
        $settings = null;

        $server_time = \Illuminate\Support\Carbon::now();
        $month = $server_time->format('M');
        $year = $server_time->format('Y');
        $date = $server_time->format('d');
        $hour = $server_time->format('H');
        $minute = $server_time->format('i');
        $second = $server_time->format('s');
        $server_time = $month.' '.$date.','.$year.' '.$hour.':'.$minute.':'.$second;
        try{
            $settings = Settings::find(1);
            if($settings == null){
                return response()->json(['status'=>false, "message"=> "Sorry! Settings not found"]); 
            }
        }catch(Exception $ex){$error = $ex->getMessage();}
        if($error==null && $settings!=null):
            return response()
            ->json(['status'=>true, "message"=> "Succesful", "exam_start_time" => $settings->exam_start_time, 'server_time'=>$server_time ], 200);
        else:
            return response()
            ->json(['status'=>false, "message"=> "Sorry! Some error occured"], 500);
        endif;
    }


    public function GetExamEndTime()
    {
        $error = null;
        $settings = null;   
        $server_time = \Illuminate\Support\Carbon::now();
        $month = $server_time->format('M');
        $year = $server_time->format('Y');
        $date = $server_time->format('d');
        $hour = $server_time->format('H');
        $minute = $server_time->format('i');
        $second = $server_time->format('s');
        $server_time = $month.' '.$date.','.$year.' '.$hour.':'.$minute.':'.$second;       
        try{
            $settings = Settings::find(1);
            if($settings == null){
                return response()->json(['status'=>false, "message"=> "Sorry! Settings not found"] ); 
            }
        }catch(Exception $ex){$error = $ex->getMessage();}
        if($error==null && $settings!=null):
            return response()
            ->json(['status'=>true, "message"=> "Succesful", "exam_end_time" => $settings->exam_end_time, 'server_time'=>$server_time ], 200);
        else:
            return response()
            ->json(['status'=>false, "message"=> "Sorry! Some error occured"], 500);
        endif;
    }
   
}
