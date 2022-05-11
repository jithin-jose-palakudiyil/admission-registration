<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\QuizQuestions;
use Modules\Admin\Repositories\QuizQuestionsRepository;
use Exception;

class QuizQuestionsController extends Controller
{
    protected $repository;
     
    public function __construct(QuizQuestions $quiz_question)
    {   
        $this->defaultUrl           =   route('quiz-questions');
        $this->createUrl            =   route('quiz-questions.create');  
        $this->createMessage        =   'Questions is created successfully.';
        $this->createErrorMessage   =   'Questions is not created successfully.';
        $this->updateMessage        =   'Questions is updated successfully.';
        $this->updateErrorMessage   =   'Questions is not updated successfully.';
        $this->deleteMessage        =   'Questions is deleted successfully.';
        $this->deleteErrorMessage   =   'Questions is not deleted successfully.';  
        $this->repository           =   new QuizQuestionsRepository($quiz_question);    
    }
    
     /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function AllQuizQuestions (Request $request)
    {
        return \DataTables::of(QuizQuestions::where('quiz_id',$request->quiz_id)->orderBy('id','desc')->get())->make(true);   
    }
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if($request->exists('quiz')):
            $quiz = \Modules\Admin\Entities\Quiz::find($request->quiz);
            if($quiz): 
                $page_title="Scholarship Exam - ".$quiz->name;  $active='quiz';
                $CreateBtn = array('url'=>$this->createUrl.'?quiz='.$quiz->id,'btn_txt'=>'New Questions');
                $breadcrumb = array(   
                                        array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                        array ("title" => 'Scholarship Exam', "url" => route('quiz') ),
                                        array ("title" => 'Scholarship Exam Questions', "active" => 1,"url" => $this->defaultUrl.'?quiz='.$quiz->id ), //only last add active page array
                                   );  
                return view('admin::quiz.questions.index', compact('page_title','active','breadcrumb','CreateBtn','quiz'));
            else: abort(404); endif; 
        else: abort(404); endif;
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request,QuizQuestions $quiz_question)
    {
        if($request->exists('quiz')):
            $quiz = \Modules\Admin\Entities\Quiz::find($request->quiz);
            if($quiz): 
                $page_title="Scholarship Exam - ".$quiz->name;  $active='quiz'; 
                $breadcrumb = array(   
                                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                array ("title" => 'Scholarship Exam Questions', "url" => $this->defaultUrl.'?quiz='.$quiz->id ),  
                                array ("title" => 'Create', "active" => 1,"url" => '' ), //only last add active page array
                                
                           ); 
                $type = 'create';
                return view('admin::quiz.questions.form', compact('page_title','active','breadcrumb','quiz_question','quiz', 'type'));
            else: abort(404); endif; 
        else: abort(404); endif;
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
       $request->validate([ 
           "quiz"     =>  "required|numeric",
            'question_youtube_id'=>'required|max:255',  
            "status"     =>  "required|numeric",   
            "answers_show_status"     =>  "required|max:255", 
            'time_of_answers' => 'required_if:answers_show_status,timer',  
            // "answers"    => "required|array",
            // "answers.*"  => "required|max:255",
           
        ]);
       if($request->exists('quiz')):
            $quiz = \Modules\Admin\Entities\Quiz::find($request->quiz);
            if($quiz): 
                if(!$request->ajax()): 
                    $store  =   $this->repository->create($request->all()); 
                    if($store["error"] == null): 
                        $request->session()->flash('flash-success-message',$this->createMessage);
                        if($store["data"] != null):
                            return \Redirect::to(route('quiz-questions.edit', [$store['data']->id])); 
                        else:
                            $request->session()->flash('flash-error-message',$this->createErrorMessage.'<br/> '.$store);
                            return \Redirect::back();
                        endif;
                    else: 
                        $request->session()->flash('flash-error-message',$this->createErrorMessage.'<br/> '.$store);
                        return \Redirect::back();
                    endif;
                else:
                    return response()->json(['message' => 'Page not found!'], 404);
                endif;
            else: abort(404); endif; 
        else: abort(404); endif;
    }
 

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    { 
        $quiz_question = QuizQuestions::with('hasManyAnswers')->where('id',$id)->first();
        if($quiz_question):
            $quiz = \Modules\Admin\Entities\Quiz::find($quiz_question->quiz_id);
            if($quiz):  
                $page_title="Scholarship Exam - ".$quiz->name;  $active='quiz'; 
                $breadcrumb = array(   
                                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                array ("title" => 'Scholarship Exam Questions', "url" => $this->defaultUrl.'?quiz='.$quiz->id ),  
                                array ("title" => 'Edit', "active" => 1,"url" => '' ), //only last add active page array

                           );
                $type = 'edit';
               return view('admin::quiz.questions.form', compact('page_title','active','breadcrumb','quiz','quiz_question', 'type'));
            else: abort(404); endif; 
        else: abort(404); endif;
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, QuizQuestions $quiz_question)
    {
        $request->validate([ 
           
            'question_youtube_id'=>'required|max:255',  
            "status"     =>  "required|numeric",   
            "answers_show_status"     =>  "required|max:255", 
            'time_of_answers' => 'required_if:answers_show_status,timer',  
            // "answers"    => "required|array",
            // "answers.*"  => "required|max:255",
           
        ]);
         $update = $this->repository->update($request->all(), $quiz_question); 
        if($update == null): 
            $request->session()->flash('flash-success-message',$this->updateMessage);
            return \Redirect::to(route('quiz-questions').'?quiz='.$quiz_question->quiz_id);
        else: 
            $request->session()->flash('flash-error-message',$this->updateErrorMessage.'<br/> '.$update);
            return \Redirect::back();
        endif;
        
    }


    public function AnswerStoreUpate(QuizQuestions $quiz_question, Request $request)
    {

        if(($request->exists('answer') && $request->answer == null) || ($request->exists('is_answer') && $request->is_answer==null)):
            $request->session()->flash('flash-error-message', "Answer field is required ");
            return response()->json(["status"=>false, "type"=>'no_answer', "message"=>"Answer field or correct answer is required"], 404);
        endif;

        $error = null;
        if($quiz_question):
            try{
                if($request->is_answer==1):
                   \Modules\Admin\Entities\QuizAnswers::where("quiz_question_id",$quiz_question->id)->update(["is_answer"=>0]);
                endif;
                if($request->exists('answer_id') && $request->answer_id!=null):
                    $quiz_answer = \Modules\Admin\Entities\QuizAnswers::where("quiz_question_id",$quiz_question->id)->where('id',$request->answer_id)->first();
                    if($quiz_answer): 
                        $quiz_answer->update(["answer"=>$request->answer,"is_answer"=>$request->is_answer]);
                        $request->session()->flash('flash-success-message', "Answer updated successfully !");
                        return response()->json(["status"=>true, "message"=>"Answer updated successfully"], 201);
                    else:abort(404); endif;
                else:
                    \Modules\Admin\Entities\QuizAnswers::create(['quiz_question_id' =>$quiz_question->id, "answer"=>$request->answer, "is_answer"=>$request->is_answer]);
                    $request->session()->flash('flash-success-message', "Answer added successfully !");
                    return response()->json(["status"=>true, "message"=>"Answer added successfully"], 201);
                endif;
            }catch(Exception $ex) { $error = $ex->getMessage();}
            if($error != null):
                $request->session()->flash('flash-error-message', "Something went wrong");
                return response()->json(["status"=>false, "message"=>"Something went wrong"], 500);
            endif;
        else: abort(404); endif;
    }


    public function AnswerDelete(QuizQuestions $quiz_question, Request $request)
    {
        $error = null;
        if($quiz_question):
            try{
                if($request->exists('answer_id') && $request->answer_id!=null):
                    $quiz_answer = \Modules\Admin\Entities\QuizAnswers::where("quiz_question_id",$quiz_question->id)->where('id',$request->answer_id)->first();
                    if($quiz_answer):
                        $quiz_answer->delete();
                        return response()->json(["status"=>true, "message"=>"Answer deleted successfully"], 201);
                    else:abort(404); endif;
                else:abort(404); endif;
            }catch(Exception $ex) { $error = $ex->getMessage();}
            if($error != null):
                $request->session()->flash('flash-error-message', "Something went wrong");
                return response()->json(["status"=>false, "message"=>"Something went wrong"], 500);
            endif;
        else: abort(404); endif;
    }



    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(QuizQuestions $quiz_question)
    {
         if(\Request::ajax()): 
            $error = $msg = null;
            try{   if($quiz_question):  $quiz_question->delete(); endif;
            } catch (Exception $ex) {  $error = $ex->getMessage();  }

            if($error == null):      
                \Session::flash('flash-success-message',$this->deleteMessage);
                $msg=array('type'=>'success'); 
            else: 
                 \Session::flash('flash-success-message',$this->deleteErrorMessage);
                $msg=array('type'=>'error'); 
            endif;
        else:
            \Session::flash('flash-success-message',$this->deleteErrorMessage);
            $msg=array('type'=>'error');
        endif; 
        return response()->json($msg, 200);
    }
}
