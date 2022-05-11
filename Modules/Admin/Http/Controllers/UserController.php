<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\User;
use Exception;
use PDF;



class UserController extends Controller
{

    public function __construct(User $User)
    {   
        $this->defaultUrl           =   route('users');
    }


    public function AllUsers(Request $request)
    {
       
        $user = User::
//                select(\DB::raw('DISTINCT(users.*)'))
                select('users.*')
                ->orderBy('users.id','desc');
        if($request->exists('college') && $request->college!=null):
            $user->join('pivot_user_category_colleges_courses','pivot_user_category_colleges_courses.user_id', 'users.id');
            $user->where('pivot_user_category_colleges_courses.college_id',$request->college);
        endif;
        
        $users = $user->get();
        $users = $users->unique('id');
//        dd($users->unique('id'));
//        $users = $user->get();
        return \DataTables::of($users)->make(true);   
    }


    public function index(Request $request)
    {

        $page_title="Applications";  $active='users';
        $CreateBtn = null; 
        if($request->exists('college_id') && $request->college_id !=null):
            $CreateBtn = array('url'=>route('download_excel_clgs',$request->college_id),'btn_txt'=>'Download Excel');  
        endif;
        $breadcrumb = array(   
                                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                array ("title" => 'Applications', "active" => 1,"url" => $this->defaultUrl ), //only last add active page array
                           );  
        return view('admin::users.index', compact('request','page_title','active','breadcrumb','CreateBtn','request'));
     
    }


    public function show($id, Request $request)
    {
        $user = null;
        $error = null;
        $user = null;
        $active='users';
        $page_title="User Details";
        try{
            $user = User::find($id);
            if(!$user){
                $request->session()->flash('flash-error-message',"User not found");
                return \Redirect::route('users');  
            }
        }catch(Exception $ex) { $error = $ex->getMessage();}
        if($error == null):
            $selectedCategories = [];
           $AssignUserCategoryCollegesCoursesAll = \Modules\Web\Entities\AssignUserCategoryCollegesCourses::where('user_id', $user->id)->get(); 
            foreach ($AssignUserCategoryCollegesCoursesAll->unique('courses_category_id') as $key => $value) {
                $category = \Modules\Admin\Entities\CoursesCategory::where('id', $value->courses_category_id)->first();
                array_push($selectedCategories, $category);
            }
            $breadcrumb = array(   
                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                array ("title" => 'Users',"url" => $this->defaultUrl ),  
                array ("title" => 'View User', "active" => 1,"url" => '' ), //only last add active page array
                
           );
            $CreateBtn = array('url'=>route('download_user_pdf', [$user->id]),'btn_txt'=>'Download as PDF');
//             $CreateBtn = null;
            return view('admin::users.show', compact("user", "selectedCategories", 'CreateBtn', 'breadcrumb', 'active', 'page_title'));
        else:
            $request->session()->flash('flash-error-message',"An error occurred");
            return \Redirect::route('users');
        endif;

    }


    public function edit($id)
    {
        return view('admin::edit');
    }


    public function destroy(User $user)
    {
         if(\Request::ajax()): 
            $error = $msg = null;
            try{   if($user):  $user->delete(); endif;
            } catch (Exception $ex) {  $error = $ex->getMessage();  }

            if($error == null):      
                \Session::flash('flash-success-message',"User is deleted successfully");
                $msg=array('type'=>'success'); 
            else: 
                 \Session::flash('flash-success-message',"User not deleted successfully");
                $msg=array('type'=>'error'); 
            endif;
        else:
            \Session::flash('flash-success-message',"User not deleted successfully");
            $msg=array('type'=>'error');
        endif; 
        return response()->json($msg, 200);
    }
    

    public function download_users_excel(Request $request)
    {
        
  
        $User = User::orderBy('id','desc');
      
        $user = User::orderBy('id','desc');
         
        if($request->exists('document_status')  && $request->document_status !=null): 
            
            if($request->document_status==1):
                $user->orWhereNotNull('tenth_mark_list');
                $user->orWhereNotNull('plus_one_mark_list');
                $user->orWhereNotNull('plus_two_mark_list');
                $user->orWhereNotNull('iti_diploma_mark_list');
            elseif($request->document_status==0):
                $user->whereNull('tenth_mark_list');
                $user->whereNull('plus_one_mark_list');
                $user->whereNull('plus_two_mark_list');
                $user->whereNull('iti_diploma_mark_list');
            endif;
            
        endif;
        
        if($request->exists('not_attend_any_exams') && $request->not_attend_any_exams !=null):  
            $user->with('getQuiz');
            $users =$user->orderBy('updated_at','desc')->get(); 
            if($request->not_attend_any_exams ==1):
                $users = $users->where('getQuiz','==', null);
//            elseif($request->not_attend_any_exams ==2):
//                $users = $users->where('getQuiz','!=', null);
            endif;  
        else:
            $users = $user->orderBy('updated_at','desc')->get();
        endif;
         
            $view_blade= 'admin::users.download.download_export';
        //    return view($view_blade, compact('users'));
            return \Excel::download(new \Modules\Admin\Exports\UsersExport($users,$view_blade), 'mgm_users_'.date("Ymdhisa").'.csv');
      
    }


    public function download_user_pdf($id, Request $request){
        $user = User::find($id);
       
        if(!$user){
            $request->session()->flash('flash-error-message',"User exam not found");
            return redirect()->back();  
        }
        
        $selectedCategories = [];
        $AssignUserCategoryCollegesCoursesAll = \Modules\Web\Entities\AssignUserCategoryCollegesCourses::where('user_id', $user->id)->get(); 
         foreach ($AssignUserCategoryCollegesCoursesAll->unique('courses_category_id') as $key => $value) {
             $category = \Modules\Admin\Entities\CoursesCategory::where('id', $value->courses_category_id)->first();
             array_push($selectedCategories, $category);
         }

                $data = [
                   'title' => 'User Details',
                   'user'=>$user,
                   'selectedCategories'=>$selectedCategories
                     ];
         $view_blade ='admin::users.download.download_pdf';
        
//         return view($view_blade, compact('data'));
         $pdf = PDF::loadView($view_blade, ['data'=>$data]);  
         return $pdf->download('mgm_user_'.$user->id.'.pdf');
    }
 
    public function download_excel($college_id) {
       
        $users = User::
                select('users.*')->distinct()
//                select(\DB::raw('DISTINCT(users.name,users.address,users.mobile,users.whatsapp,users.email)'))
                ->orderBy('users.id','desc')->join('pivot_user_category_colleges_courses','pivot_user_category_colleges_courses.user_id', 'users.id')->where('pivot_user_category_colleges_courses.college_id',$college_id)->get();
//         dd($users); 
//          $view_blade= 'Admin::applications.excel.download_export';
         $view_blade= 'admin::users.download.download_export_clgs';
        
         $Colleges = \Modules\Admin\Entities\Colleges::find($college_id);
         $name_download ='mgm_users_';
         if($Colleges):
             $name_download =$Colleges->name;
         endif;
         
        //    return view($view_blade, compact('userExam'));
            return \Excel::download(new \Modules\Admin\Exports\UsersExport($users,$view_blade), $name_download.'_'.date("Ymdhisa").'.csv');
      
        
    }
}
