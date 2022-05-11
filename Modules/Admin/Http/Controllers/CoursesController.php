<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Courses;
use \Modules\Admin\Repositories\CoursesRepository;

class CoursesController extends Controller
{
    protected $repository;
     
     public function __construct(Courses $course)
    {   
        $this->defaultUrl           =   route('courses');
        $this->createUrl            =   route('courses.create');  
        $this->createMessage        =   'Course is created successfully.';
        $this->createErrorMessage   =   'Course is not created successfully.';
        $this->updateMessage        =   'Course is updated successfully.';
        $this->updateErrorMessage   =   'Course is not updated successfully.';
        $this->deleteMessage        =   'Course is deleted successfully.';
        $this->deleteErrorMessage   =   'Course is not deleted successfully.';  
        $this->repository           =   new CoursesRepository($course); 
     
    }
    
     /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function AllCourses()
    {
        return \DataTables::of(Courses::orderBy('id','desc')->get())->make(true);   
    }
    
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $page_title="Courses";  $active='courses';
        $CreateBtn = array('url'=>$this->createUrl,'btn_txt'=>'New Courses');
        $breadcrumb = array(   
                                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                array ("title" => 'Courses', "active" => 1,"url" => $this->defaultUrl ), //only last add active page array
                           );  
        return view('admin::courses.index', compact('page_title','active','breadcrumb','CreateBtn'));
     
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Courses $course)
    {
       $page_title="Courses";  $active='courses'; 
        $breadcrumb = array(   
                                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                array ("title" => 'Courses', "url" => $this->defaultUrl ),  
                                array ("title" => 'Create', "active" => 1,"url" => '' ), //only last add active page array
                                
                           ); 
        return view('admin::courses.create', compact('page_title','active','breadcrumb','course'));
    
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
            'slug'=>   "required|max:255|unique:courses,slug,NULL,id,deleted_at,NULL", 
             "status"     =>  "required|numeric",         
        ]);
       if(!$request->ajax()):
            $store  =   $this->repository->create($request->all()); 
            if($store == null): 
                $request->session()->flash('flash-success-message',$this->createMessage);
                return \Redirect::route('courses'); 
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
    public function edit(Courses $course)
    {
           
        $page_title="Courses";  $active='courses'; 
        $breadcrumb = array(   
                                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                array ("title" => 'Courses', "url" => $this->defaultUrl ),  
                                array ("title" => 'Edit', "active" => 1,"url" => '' ), //only last add active page array
                                
                           ); 
        return view('admin::courses.edit', compact('page_title','active','breadcrumb','course'));
    
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Courses $course)
    {
        $request->validate([
            'name'=>'required|max:255',
            'slug'=>   "required|max:255|unique:courses,slug,$course->id,id,deleted_at,NULL", 
            "status"     =>  "required|numeric",         
        ]);
        $update = $this->repository->update($request->all(), $course); 
        if($update == null): 
            $request->session()->flash('flash-success-message',$this->updateMessage);
            return \Redirect::route('courses'); 
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
    public function destroy(Courses $course)
    {
       if(\Request::ajax()): 
            $error = $msg = null;
            try{   if($course):  $course->delete(); endif;
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
