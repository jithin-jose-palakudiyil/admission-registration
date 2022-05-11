<?php

namespace Modules\Web\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \Auth; 
use \Modules\Web\Entities\AssignUserCategoryCollegesCourses;

class CoursesCollegesController extends Controller
{

    public function index($courses_category_array)
    {
        $active = 'categories';
        $selected_categories =   json_decode(\Crypt::decryptString($courses_category_array));
        $page_title = "MGM - Colleges and courses";
        return view('web::wizard.steps.courses_colleges_step3', compact('page_title', 'selected_categories', 'active'));
    }


    public function store(Request $request)
    {
        $request->validate([ 'category_college_course' => 'array ']);

        if(!isset($request->category_college_course)){
            $request->session()->flash('store_error', 'You must select atleast one course !');
            return redirect()->back();

        }
        $user =  \Auth::guard(web_guard)->user();
        if(!$user):
            return redirect()->route('loginView');
        endif;
            $error = null;
            $data = $request->all();
            if(isset($data['_token'])):unset($data['_token']);endif;
           
            $data = array_values($data);
            $data_values = array_values($data[0]);
            $user_category_college_course = [];
            
            foreach($data_values as $key => $value)
            {
                if($value): 
                    $pieces = explode("_", $value); 
                    $courses_category_id = $pieces[0];
                    $college_id = $pieces[1];
                    $course_id = $pieces[2];
                    $preference = $pieces[3];
                    $user_category_college_course[$key]['user_id'] = Auth::guard(web_guard)->user()->id;
                    $user_category_college_course[$key]['courses_category_id'] = $courses_category_id;
                    $user_category_college_course[$key]['college_id'] = $college_id;
                    $user_category_college_course[$key]['course_id'] = $course_id;
                    $user_category_college_course[$key]['preference'] = $preference;
                endif;
           }
             
            if(empty($user_category_college_course)):
                $request->session()->flash('store_error', 'You must select atleast one course !');
                return redirect()->back();
            endif;
            
            
           try
           {
               AssignUserCategoryCollegesCourses::where('user_id',Auth::guard(web_guard)->user()->id)->delete();
               AssignUserCategoryCollegesCourses::insert($user_category_college_course);
                if($user->current_step != "step_5"): 
                    \Modules\Web\Entities\User::where('id', Auth::guard(web_guard)->user()->id)->update(['current_step' => 'step_4']);
                endif;
           }catch(Exception $ex){$error=$ex->getMessage();}
            
           if($error == null):
                if($user->current_step == "step_5"): 
                    $request->session()->flash('flash-success-message', 'Updated Successfully!');
                    return redirect()->route('dashboard_web');
                else:
                    return redirect()->route('courses_accademic_step');
                endif; 
           else:
                $request->session()->flash('store_error', 'Sorry something went wrong !');
               return redirect()->back();
           endif;
    }

   
}
