<?php

namespace Modules\Colleges\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Colleges\Entities\User;
use \Auth; use \PDF;
class UsersController extends Controller
{
    public function __construct(User $User)
    {   
        $this->defaultUrl           =   route('colleges_users_list');
    }
    

    public function users_list(Request $request)
    {
        $college = Auth::guard(colleges_guard)->user();
        $query = User::select('users.*')->orderBy('users.id','desc');
        $query->join('pivot_user_category_colleges_courses','pivot_user_category_colleges_courses.user_id','users.id');
        $query->where('pivot_user_category_colleges_courses.college_id',$college->id); 
        $users = $query->get();
        $users=$users->unique('users.id');
        return \DataTables::of($users)->make(true);   
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
           $AssignUserCategoryCollegesCoursesAll = \Modules\Web\Entities\AssignUserCategoryCollegesCourses::where('user_id', $user->id)->where('college_id', Auth::guard(colleges_guard)->user()->id)->get(); 
            foreach ($AssignUserCategoryCollegesCoursesAll->unique('courses_category_id') as $key => $value) {
                $category = \Modules\Admin\Entities\CoursesCategory::where('id', $value->courses_category_id)->first();
                array_push($selectedCategories, $category);
            }
 
            $breadcrumb = array(   
                array ("title" => 'Dashboard', "url" => URL(colleges_guard) ),   
                array ("title" => 'View', "active" => 1,"url" => '' ), //only last add active page array
                
           );
//            $CreateBtn = array('url'=>route('clg_download_user_pdf', [$user->id]),'btn_txt'=>'Download as PDF');
             $CreateBtn = null;
            return view('colleges::users.show', compact("user", "selectedCategories", 'CreateBtn', 'breadcrumb', 'active', 'page_title'));
        else:
            $request->session()->flash('flash-error-message',"An error occurred");
            return \Redirect::route('users');
        endif;

    }
    
    
    public function download_user_pdf($id, Request $request){
        $user = User::find($id);
       
        if(!$user){
            $request->session()->flash('flash-error-message',"User exam not found");
            return redirect()->back();  
        }
        
        $selectedCategories = [];
        $AssignUserCategoryCollegesCoursesAll = \Modules\Web\Entities\AssignUserCategoryCollegesCourses::where('user_id', $user->id)->where('college_id', Auth::guard(colleges_guard)->user()->id)->get(); 
         foreach ($AssignUserCategoryCollegesCoursesAll->unique('courses_category_id') as $key => $value) {
             $category = \Modules\Admin\Entities\CoursesCategory::where('id', $value->courses_category_id)->first();
             array_push($selectedCategories, $category);
         }

                $data = [
                   'title' => 'User Details',
                   'user'=>$user,
                   'selectedCategories'=>$selectedCategories
                     ];
         $view_blade ='colleges::users.download.download_pdf';
        
//         return view($view_blade, compact('data'));
         $pdf = PDF::loadView($view_blade, ['data'=>$data]);  
         return $pdf->download('mgm_user_'.$user->id.'.pdf');
    }
    
}
