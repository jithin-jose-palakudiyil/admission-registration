<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Quiz;
use \Exception;
class ResultPublishController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request,Quiz $Quiz)
    {
         
        if($Quiz->result_published ==1): 
            $request->session()->flash('flash-error-message','Sorry result already published. we are unable to process open exams');
            return \Redirect::to(route('quiz'));    
        else:    
            if($Quiz->open_or_close==2 ):
            // Initialization
                $redirect = route('quiz');  
                session_start(); 
                $_SESSION["flash-success-message"] = 'We are successfully started result publishing process';

                //Redirect to another page
                header("Location: $redirect"); 
                //Erase the output buffer
                ob_end_clean(); 
                //Tell the browser that the connection's closed
                header("Connection: close"); 
                //Ignore the user's abort (which we caused with the redirect).
                ignore_user_abort(true);
                //Extend time limit to 60 minutes
                set_time_limit(3600);
                //Extend memory limit to 1024MB
                ini_set("memory_limit","10024MBM");
                //Start output buffering again
                ob_start(); 
                //Tell the browser we're serious... there's really nothing else to receive from this page.
                header("Content-Length: 0"); 
                //Send the output buffer and turn output buffering off.
                ob_end_flush();
                flush();
                //Close the session.
                session_write_close();  
                //process started
                $this->update_quiz($Quiz,['result_published'=>3]);
                //Do some of your work, like the queue can be ran here, 
                $Results= $this->QuizResults($Quiz);
//                $Results = false;
                if(!$Results): 
                    $this->update_quiz($Quiz,['result_published'=>2,'published_at'=>null]);
                    \Modules\Admin\Entities\UserExam::where('quiz_id',$Quiz->id)->update(['total_questions'=>null,'total_true_answer'=>null]);
                endif;
            else: 
                $_SESSION["flash-error-message"] = 'Sorry Exam not closed. we are unable to process open exams';
                return \Redirect::to(route('quiz'));   
            endif;
        endif;   
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function QuizResults($Quiz)
    {
        $error = null; 
        //Exam questions and answers
        $QuizData = $Quiz->with(array('questions' => function($query) { $query->with('hasManyAnswers');  }))->where('id',$Quiz->id)->first();
        
//        $QuizData = $Quiz->with(array('questions' => function($query) { $query->with('hasManyAnswers');  }))->first();
        if($QuizData && isset($QuizData->questions)):
           try
            { 
                //Users  answers
                $UserExams= \Modules\Admin\Entities\UserExam::with('getAttendedQuizAnswer')->where('quiz_status',1)->where('quiz_id',$Quiz->id)->get();
                $total_users= $UserExams->count(); $progress = 0;$i=1; $exam_result = [];
                $this->update_quiz($Quiz,['total_users'=>$total_users]);
                foreach ($UserExams as $key => $value) : 
                    $progress = ($i/$total_users)*100; 
                    $result= $this->AttendedQuizAnswer($QuizData, $value); 
                    $this->update_quiz($Quiz,['progress'=>(int)$progress]);
                    $i++;
                endforeach;
                if(($i-1)==$total_users): $this->update_final($Quiz);  endif; 
            }catch (Exception $ex) { $error = $ex->getMessage(); }
            if($error==null): return true;
            else: \Illuminate\Support\Facades\Log::error($error); return false; endif;
        else: abort(404); endif;
        
        
    }
    
     /**
     * Update the specified resource in storage.
     * @param Object $QuizData
     * @param Object $AttendedQuizWithAnswer
     * @return Renderable
     */
    public function AttendedQuizAnswer($QuizData,$AttendedQuizWithAnswer)
    {
        $error=null;
        try
        { 
            $UserAttendedQuizAnswer = $AttendedQuizWithAnswer->getAttendedQuizAnswer; 
            if($UserAttendedQuizAnswer->isNotEmpty()): 
                $is_true_answer=0;     
                foreach ($UserAttendedQuizAnswer as $UserAttendedQuizAnswer_key => $UserAttendedQuizAnswer_value):
                    //check the question is answered by user
                    if($UserAttendedQuizAnswer_value->answered ==1): 
                        //get the orginal question from user attend
                        $question = $QuizData->questions->where('id',$UserAttendedQuizAnswer_value->quiz_question_id)->first();

                        if($question): 
                            //get the orginal question & answers from user attend
                            $answers =$question->hasManyAnswers->where('id',$UserAttendedQuizAnswer_value->quiz_answer_id)->first();
                            //check the answer is correct, if yes add mark
                            if($answers->is_answer==1):  $is_true_answer=$is_true_answer+1; endif;
                        endif; 
                    endif;
                endforeach; 
                //update result 
                \Modules\Admin\Entities\UserExam::where('id',$AttendedQuizWithAnswer->id)->update(['total_questions'=>$QuizData->questions->count(),'total_true_answer'=>$is_true_answer]);
            endif;
        } catch (Exception $ex) { $error = $ex->getMessage(); } 
        if($error==null): return true;
        else: \Illuminate\Support\Facades\Log::error($error); return false; endif;
        
                    
    }
    
    /**
     * Update the specified resource in storage.
     * @param Object $Quiz
     * @param array $array
     * @return Renderable
     */
    public function update_quiz($Quiz,$array)
    {
        if($Quiz): $Quiz->update($array); return true; else: return false; endif;
    }
    
    /**
     * Update the specified resource in storage.
     * @param Object $Quiz
     * @return Renderable
     */
    public function update_final($Quiz)
    {
        if($Quiz):
            $published_at = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')); 
            $Quiz->update(['result_published'=>1,'published_at'=>$published_at]);
            return true;
        else: return false; endif;
        
    }

    /**
     * Update the specified resource in storage.
     * @param Object $Quiz
     * @return Renderable
     */
    public function download_result(Request $request,Quiz $Quiz)
    {
         
         if($Quiz->open_or_close == '2' && $Quiz->result_published == '1'):
            $userExam= \Modules\Admin\Entities\UserExam::with('getUser')->where('quiz_status',1)->where('quiz_id',$Quiz->id)->get();
            $view_blade= 'admin::quiz.download_result_export';
//            $userExam= $userExam->sortByDesc('total_true_answer');
//            dd($userExam->sortByDesc('total_true_answer'));
//            return view($view_blade, compact('userExam'));
            return \Excel::download(new \Modules\Admin\Exports\UsersQuizResultExport($userExam,$view_blade), 'mgm_scholarship_exam_result_'.date("Ymdhisa").'.csv');
      
         else:
             $request->session()->flash('flash-error-message','Sorry result not  published. we are unable to process download');
            return \Redirect::to(route('quiz'));
         endif;
            
    }
    

    
}
