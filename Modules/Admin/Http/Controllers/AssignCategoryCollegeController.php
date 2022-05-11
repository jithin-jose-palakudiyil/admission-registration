<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Colleges;
use \Modules\Admin\Entities\Courses;
use \Modules\Admin\Entities\AssignCategoryCollege;
use \Exception;
class AssignCategoryCollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($id)
    {
        $courses = Courses::find($id);
        if($courses):
            $page_title="Assign ";  $active='courses';
            $breadcrumb = array(   
                                 array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                 array ("title" => 'Courses',"url" => route('courses') ), //only last add active page array
                                 array ("title" => 'Assign Colleges and Category', "active" => 1,"url" => route('assign_category_college_list',$courses->id) ), //only last add active page array
                            ); 
            $CollegesWithCategory = Colleges::with('belongsToCategory')->get(); 
            return view('admin::courses.assign.index', compact('page_title','active','breadcrumb','courses','CollegesWithCategory'));
       else: abort(404); endif;
    }

   
   

  
 

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $courses = Courses::find($id);
        if($courses): 
            $error = null; $clg_category = [];
            try
            {
                AssignCategoryCollege::where('course_id',$courses->id)->delete();
                if($request->exists('assign')): 
                    foreach ($request->assign as $key => $value) :
                        $explode = explode('_', $value);
                        if(!empty($explode) && count($explode) == 2): 
                            $clg_category[$key]['college_id']=$explode[0];
                            $clg_category[$key]['courses_category_id']=$explode[1];
                            $clg_category[$key]['course_id']=$courses->id;
                        endif; 
                    endforeach; 
                    if(!empty($clg_category)): AssignCategoryCollege::insert($clg_category); endif;  
                endif;
                if($error==null):
                 $request->session()->flash('flash-success-message','Assigning successfully completed');
                else:
                    $request->session()->flash('flash-error-message','Assigning not completed successfully<br/> '.$error);
                endif;
                return \Redirect::route('courses'); 
            } catch (Exception $ex) { $error = $ex->getMessage(); }
        else: abort(404); endif;
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
