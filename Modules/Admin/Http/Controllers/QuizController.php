<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Repositories\QuizRepository;
use Modules\Admin\Entities\Quiz;

class QuizController extends Controller
{
    protected $repository;
     
     public function __construct(Quiz $quiz)
    {   
        $this->defaultUrl           =   route('quiz');
        $this->createUrl            =   route('quiz.create');  
        $this->createMessage        =   'Scholarship exam is created successfully.';
        $this->createErrorMessage   =   'Scholarship exam is not created successfully.';
        $this->updateMessage        =   'Scholarship exam is updated successfully.';
        $this->updateErrorMessage   =   'Scholarship exam is not updated successfully.';
        $this->deleteMessage        =   'Scholarship exam is deleted successfully.';
        $this->deleteErrorMessage   =   'Scholarship exam is not deleted successfully.';  
        $this->repository           =   new QuizRepository($quiz);    
    }
    
     /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function AllQuiz()
    {
        return \DataTables::of(Quiz::orderBy('id','desc')->get())->make(true);   
    }
    
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $page_title="Scholarship Exam";  $active='quiz';
        $CreateBtn = array('url'=>$this->createUrl,'btn_txt'=>'New Scholarship Exam');
        $breadcrumb = array(   
                                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                array ("title" => 'Scholarship Exam', "active" => 1,"url" => $this->defaultUrl ), //only last add active page array
                           );  
        return view('admin::quiz.index', compact('page_title','active','breadcrumb','CreateBtn'));
    
        
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Quiz $quiz)
    {
        $page_title="Scholarship Exam";  $active='quiz'; 
        $breadcrumb = array(   
                                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                array ("title" => 'Scholarship Exam', "url" => $this->defaultUrl ),  
                                array ("title" => 'Create', "active" => 1,"url" => '' ), //only last add active page array
                                
                           ); 
        return view('admin::quiz.create', compact('page_title','active','breadcrumb','quiz'));
    
       
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
      
       $request->validate([
            'name'=>'required|max:255',
            'button_text'=>   "required|max:255", 
            "status"     =>  "required|numeric",  
            "review_quiz"     =>  "required|numeric",  
            "video_id"     =>  "required|max:255", 
            "btn_show_status"     =>  "required|max:255", 
            'time_of_btn' => 'required_if:btn_show_status,timer',
            'description'=>'required',
            'exam_completed_description'=>'required',
            'exam_type'=>'required',
           'exams' => 'required_if:exam_type,re_exam_for_previous',
           'exams_status' => 'required_if:exam_type,re_exam_for_previous|numeric',
           'date_users_reg_re_exam' => 'required_if:is_need_new_users,1',
        ]);
      
        if(!$request->ajax()):
            $store  =   $this->repository->create($request->all()); 
            if($store == null): 
                $request->session()->flash('flash-success-message',$this->createMessage);
                return \Redirect::route('quiz'); 
            else: 
                $request->session()->flash('flash-error-message',$this->createErrorMessage.'<br/> '.$store);
                return \Redirect::back();
            endif;
        else:
            return response()->json(['message' => 'Page not found!'], 404);
        endif;
          
    }

    

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Quiz $quiz)
    {
        $page_title="Scholarship Exam";  $active='quiz'; 
        $breadcrumb = array(   
                                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                array ("title" => 'Scholarship Exam', "url" => $this->defaultUrl ),  
                                array ("title" => 'Edit', "active" => 1,"url" => '' ), //only last add active page array
                                
                           ); 
        return view('admin::quiz.edit', compact('page_title','active','breadcrumb','quiz'));
    
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Quiz $quiz)
    {
         
        $request->validate([
            'name'=>'required|max:255',
            'button_text'=>   "required|max:255", 
            "status"     =>  "required|numeric",  
            "review_quiz"     =>  "required|numeric",  
            "video_id"     =>  "required|max:255", 
            "btn_show_status"     =>  "required|max:255", 
            'time_of_btn' => 'required_if:btn_show_status,timer',
            'description'=>'required',
            'exam_completed_description'=>'required',
            'exam_completed_description'=>'required',
            'exam_type'=>'required',
           'exams' => 'required_if:exam_type,re_exam_for_previous',
           'exams_status' => 'required_if:exam_type,re_exam_for_previous|numeric',
           'date_users_reg_re_exam' => 'required_if:is_need_new_users,1',

        ]);
        $update = $this->repository->update($request->all(), $quiz); 
        if($update == null): 
            $request->session()->flash('flash-success-message',$this->updateMessage);
            return \Redirect::route('quiz'); 
        else: 
            $request->session()->flash('flash-error-message',$this->updateErrorMessage.'<br/> '.$update);
            return \Redirect::back();
        endif;
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy( Quiz $quiz)
    {
        if(\Request::ajax()): 
            $error = $msg = null;
            try{   if($quiz):  $quiz->delete(); endif;
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
    
    
    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function close_quiz(Request $request, Quiz $quiz)
    {
        if(\Request::ajax()):
            if($quiz->open_or_close ==1): 
            $error = $msg = null;
            try{   if($quiz):  $quiz->update(['open_or_close'=>2]); endif;
            } catch (Exception $ex) {  $error = $ex->getMessage();  }
            else:
                $error = 'Quiz already closed';
            endif;
            if($error == null):      
                \Session::flash('flash-success-message','Quiz closed successfully');
                $msg=array('type'=>'success'); 
            else: 
                 \Session::flash('flash-error-message','Quiz not closed successfully');
                $msg=array('type'=>'error'); 
            endif;
        else:
            \Session::flash('flash-error-message','Quiz not closed successfully');
            $msg=array('type'=>'error');
        endif; 
        return response()->json($msg, 200);
        
    }
    
     /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function GetExams(Request $request)
    { 
        if($request->exists('previous') && $request->previous == 're_exam_for_previous'):
            $edit = null;
            $quiz = Quiz::where('open_or_close',2)->select('id','name'); //where('status',1)->get()
            if($request->exists('edit')):
                $quiz =  $quiz->where('id','!=',$request->edit); 
            endif;
            $edit = Quiz::find($request->edit);
            $quiz =  $quiz->get();
            if($quiz->isNotEmpty()):
              $html =  \View::make('admin::quiz.exams_with_status', compact('quiz','edit'))->render();
                return response()->json(['status'=>1,'html' =>$html], 200);  
            else: 
                return response()->json(['status'=>3,'message' => '<div style="color:red;margin-left: 10px;margin-bottom: 10px;padding: 10px;font-weight: 700;border: 1px solid;">No exams found</div>'], 200);   
            endif;
            
        else: return response()->json(['status'=>2,'message' => 'Not Found.'], 404);  endif;
    }
    
     /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function OpenExams(Request $request,Quiz $quiz)
    { 
        $open = Quiz::where('open_or_close',1)->get();
        if($open->isNotEmpty()):
            $request->session()->flash('flash-error-message','Please close the opend exams before open this exam');
        else:
            $quiz->update(['open_or_close'=>1]);
            $request->session()->flash('flash-success-message','Exam successfully opened');
        endif;
      return \Redirect::route('quiz');
    }
    
    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function not_attended_users(Request $request)
    { 
        $attended = \DB::table('users')->join('user_exam','user_exam.user_id' ,'=' ,'users.id')->select('users.id')->get();
        if($attended):
            $attended_ids= $attended->pluck('id')->unique()->toArray();
        
            if(!empty($attended_ids)):
                $not_attended_users = \DB::table('users')->select('users.*')->whereNotIn('id', $attended_ids)->get();
                if($not_attended_users->isNotEmpty()):
                    $view_blade= 'admin::users.download.download_not_attended_export';
                    return \Excel::download(new \Modules\Admin\Exports\UsersNotAttendedExport($not_attended_users,$view_blade), 'mgm_users_'.date("Ymdhisa").'.csv');
      
                else:
                    $request->session()->flash('flash-error-message','users not found');
                    return \Redirect::back();
                endif;
                
            else:
                $request->session()->flash('flash-error-message','users not found');
                return \Redirect::back();
            endif;
        else:
            $request->session()->flash('flash-error-message','users not found');
            return \Redirect::back();
        endif;
        
        
    }
    
    
}
