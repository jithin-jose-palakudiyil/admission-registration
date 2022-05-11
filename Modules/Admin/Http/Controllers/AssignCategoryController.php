<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\AssignColleges;
use Modules\Admin\Entities\Colleges;
use \Exception;

class AssignCategoryController extends Controller
{ 
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($id)
    {
       $colleges = Colleges::find($id);
       if($colleges):
            $AssignColleges = AssignColleges::select('courses_category_id')->where('college_id',$colleges->id)->get();
            $page_title="Assign ";  $active='colleges';
            $breadcrumb = array(   
                                 array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                 array ("title" => 'Colleges',"url" => route('colleges') ), //only last add active page array
                                 array ("title" => 'Assign', "active" => 1,"url" => route('assign_category_list',$colleges->id) ), //only last add active page array
                            );  
            $AssignColleges = $AssignColleges->pluck('courses_category_id')->toArray(); 
            $CoursesCategory = \Modules\Admin\Entities\CoursesCategory::where('status',1)->get();
            return view('admin::colleges.assign.index', compact('page_title','active','breadcrumb','CoursesCategory','colleges','AssignColleges'));
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
        $colleges = Colleges::find($id);
        if($colleges):
            $error = null;
            try
            { 
                if($request->exists('assign')):
                     $assign = $request->assign; 
                     $colleges->assign_colleges_category()->sync($assign);
                else: 
                    AssignColleges::where('college_id',$colleges->id)->delete(); 
                endif;
            } catch (Exception $ex) { $error = $ex->getMessage(); }
            
            if($error==null):
                 $request->session()->flash('flash-success-message','Assigning successfully completed');
            else:
                $request->session()->flash('flash-error-message','Assigning not completed successfully<br/> '.$error);
            endif;
            return \Redirect::route('colleges');
        else: abort(404); endif;
 
    }
 
}
