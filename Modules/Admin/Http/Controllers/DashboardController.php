<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\UserExam;
use Modules\Admin\Entities\User;
use Exception;
use PDF;


class DashboardController extends Controller
{


    public function __construct()
    {   
        $this->defaultUrl           =   route('admin_dashboard');
    }


    public function index()
    {
        $page_title="MGM - dashboard";  $active='dashboard';  
        $breadcrumb = array( array ("title" => 'Dashboard', "active" => 1,"url" => $this->defaultUrl ) );
        $user_count = User::select('*')->get()->count();
        return view('admin::dashboard.index', compact('page_title','active','breadcrumb','user_count'));
  
    }

    public function AllUsersQuiz()
    {
        return \DataTables::of(UserExam::with('getUser')->with('getQuiz')->orderBy('id','desc')->get())->make(true);   
    }


    public function AllUsersQuizFiltered(Request $request)
    {

        if( ( $request->exists('exam_id') && $request->exam_id ==null ) &&  ( $request->exists('exam_status') && $request->exam_status ==null ) && ($request->exists('document') && $request->document ==null)):
            return response()->json(['status' => false, 'msg' =>"Please enter a filter criteria !"], 422);
        endif;

        try
        {
            $query = UserExam::with('getUser')->with('getQuiz');
            
            $document = null;
            if($request->exists('document') && $request->document!=null): 
                $query->join('users', 'users.id', '=', 'user_exam.user_id');
//                if($request->document==1):
//                    $query->orWhere('users.tenth_mark_list','!=' , null);
//                    $query->orWhere('users.plus_one_mark_list','!=' , null);
//                    $query->orWhere('users.plus_two_mark_list','!=' , null);
//                    $query->orWhere('users.iti_diploma_mark_list','!=' , null);
//                elseif($request->document==0):
//                    $query->whereNull('users.tenth_mark_list');
//                    $query->whereNull('users.plus_one_mark_list');
//                    $query->whereNull('users.plus_two_mark_list');
//                    $query->whereNull('users.iti_diploma_mark_list');
//                endif;
            
                $document = $request->document; 
            endif;
            if($document !=null): 
                $query->where(function ($query) use ($document) {
                        if($document==1):
                            $query->orWhere('users.tenth_mark_list','!=' , null);
                            $query->orWhere('users.plus_one_mark_list','!=' , null);
                            $query->orWhere('users.plus_two_mark_list','!=' , null);
                            $query->orWhere('users.iti_diploma_mark_list','!=' , null);
                        elseif($document==0):
                            $query->whereNull('users.tenth_mark_list');
                            $query->whereNull('users.plus_one_mark_list');
                            $query->whereNull('users.plus_two_mark_list');
                            $query->whereNull('users.iti_diploma_mark_list');
                        endif;   
                    });
                
            endif;    
                
            if($request->exists('exam_id') && $request->exam_id !=null ):
                $query->where('user_exam.quiz_id', $request->exam_id);
            endif;
    
            if($request->exists('exam_status') && $request->exam_status !=null ):
                $query->where('user_exam.quiz_status', $request->exam_status);
            endif;
            

//            \DB::connection()->enableQueryLog();
            $data =$query->get();
//            $queries = \DB::getQueryLog();
//             dd($queries);
//            dd($data);
            $totalExams = $data->count();
            $filterCompleted = $data->filter(function ($value, $key) {
                return $value->quiz_status == 1;
            });
            $filterInProgress = $data->filter(function ($value, $key) {
                return $value->quiz_status != 1;
            });
            
            return response()->json([
                'status' => true, 
                'data'=> $data, 
                'totalExams' => $totalExams, 
                'filterCompleted'=> $filterCompleted->count(), 
                'filterInProgress'=> $filterInProgress->count(),
                'msg'=> "Data retrieved successfully !"], 200);
        }catch(Exception $ex){
            return response()->json(['status' => false, 'msg' =>"Sorry ! some error occurred: ".$ex->getMessage()], 500);
        }
    }


    public function show($id, Request $request)
    {
        $userExam = null;
        $error = null;
        $active='dashboard'; 
        $page_title="MGM - Attended User Scholarship Exams";
            try{
            $userExam = UserExam::with('getUser')->with('getQuiz')->find($id);
            if(!$userExam){
                $request->session()->flash('flash-error-message',"User exam not found");
                return redirect()->back();  
            }
        }catch(Exception $ex) { $error = $ex->getMessage();}
        if($error == null):
            $breadcrumb = array(   
                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                array ("title" => 'Attended User Scholarship Exams',"url" => $this->defaultUrl ),  
                array ("title" => 'View Exam Details', "active" => 1,"url" => '' ), //only last add active page array
                
           );
            $CreateBtn = array('url'=>route('download_user_quiz_pdf', [$userExam->id]),'btn_txt'=>'Download as PDF');

            return view('admin::dashboard.show', compact("userExam", 'page_title', 'CreateBtn', 'breadcrumb', 'active'));
        else:
            $request->session()->flash('flash-error-message',"An error occurred");
            return \Redirect::route('user_quiz.index');
        endif;

    }


    public function download_users_quiz_excel(Request $request)
    {
        
            $userExam = UserExam::with('getUser')->with('getQuiz')->get(); 
            $view_blade= 'admin::dashboard.download.download_export';

        //    return view($view_blade, compact('userExam'));
            return \Excel::download(new \Modules\Admin\Exports\UsersQuizExport($userExam,$view_blade), 'mgm_scholarship_exam_'.date("Ymdhisa").'.csv');
      
    }


    public function download_filtered_user_quiz_excel($exam_id, $exam_status,$document, Request $request)
    {

        if($exam_status == 'no_exam_status' && $exam_id == 'no_exam_id' && $exam_id == 'no_document'):
            $request->session()->flash('flash-error-message',"Please enter a filter criteria to download ");
            return redirect()->back();
        endif;
        try{
            
            $query = UserExam::with('getUser')->with('getQuiz');
            if($document !=null && $document != 'no_document' ):
                $query->join('users', 'users.id', '=', 'user_exam.user_id');
                $query->where(function ($query) use ($document)
                {
                    if($document==1):
                        $query->orWhere('users.tenth_mark_list','!=' , null);
                        $query->orWhere('users.plus_one_mark_list','!=' , null);
                        $query->orWhere('users.plus_two_mark_list','!=' , null);
                        $query->orWhere('users.iti_diploma_mark_list','!=' , null);
                    elseif($document==0):
                        $query->whereNull('users.tenth_mark_list');
                        $query->whereNull('users.plus_one_mark_list');
                        $query->whereNull('users.plus_two_mark_list');
                        $query->whereNull('users.iti_diploma_mark_list');
                    endif;   
                }); 
                $query->orderBy('users.updated_at','desc'); 
            endif; 
            if($exam_id !=null && $exam_id != 'no_exam_id' ): $query->where('quiz_id', $exam_id)->get(); endif;
            if($exam_status !=null && $exam_status != 'no_exam_status'): $query->where('quiz_status', $exam_status)->get(); endif;
            $data = $query->get(); 
            if($data->count() == 0):
                $request->session()->flash('flash-error-message',"There is nothing to download here !");
                return redirect()->back();
            endif; 

            $view_blade= 'admin::dashboard.download.download_export';
//            return view($view_blade, compact('data'));
            return \Excel::download(new \Modules\Admin\Exports\UsersQuizExport($data,$view_blade), 'mgm_scholarship_exam_'.date("Ymdhisa").'.csv');

        }catch(Exception $ex){
            $request->session()->flash('flash-error-message',"An error occurred".$ex->getMessage());
            return redirect()->back();
        }
    }




    public function download_user_quiz_pdf($id, Request $request)
    {

        $userExam = UserExam::with('getUser')->with('getQuiz')->find($id);
        if(!$userExam){
            $request->session()->flash('flash-error-message',"User exam not found");
            return redirect()->back();  
        }
                $data = [
                   'title' => 'Scholarship Exam Details',
                   'userExam'=>$userExam,
                     ];
         
         $pdf = PDF::loadView('admin::dashboard.download.download_pdf', $data);  
         return $pdf->download('mgm_scholarship_exam_'.date("Ymdhisa").'.pdf');
    }   


}
