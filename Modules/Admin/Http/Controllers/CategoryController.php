<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Repositories\CategoryRepository;
use Modules\Admin\Entities\CoursesCategory;

class CategoryController extends Controller
{
    
    protected $repository;
     
     public function __construct(CoursesCategory $CoursesCategory)
    {   
        $this->defaultUrl           =   route('category');
        $this->createUrl            =   route('category.create');  
        $this->createMessage        =   'Category is created successfully.';
        $this->createErrorMessage   =   'Category is not created successfully.';
        $this->updateMessage        =   'Category is updated successfully.';
        $this->updateErrorMessage   =   'Category is not updated successfully.';
        $this->deleteMessage        =   'Category is deleted successfully.';
        $this->deleteErrorMessage   =   'Category is not deleted successfully.';  
        $this->repository           =   new CategoryRepository($CoursesCategory); 
     
    }
    
      /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function AllCategory()
    {
        return \DataTables::of(CoursesCategory::orderBy('id','desc')->get())->make(true);   
    }
    
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $page_title="Category";  $active='category';
        $CreateBtn = array('url'=>$this->createUrl,'btn_txt'=>'New Category');
        $breadcrumb = array(   
                                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                array ("title" => 'Category', "active" => 1,"url" => $this->defaultUrl ), //only last add active page array
                           );  
        return view('admin::category.index', compact('page_title','active','breadcrumb','CreateBtn'));
     
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(CoursesCategory $CoursesCategory)
    {
       $page_title="Category";  $active='category'; 
        $breadcrumb = array(   
                                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                array ("title" => 'Category', "url" => $this->defaultUrl ),  
                                array ("title" => 'Create', "active" => 1,"url" => '' ), //only last add active page array
                                
                           ); 
        return view('admin::category.create', compact('page_title','active','breadcrumb','CoursesCategory'));
    
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
            'slug'=>   "required|max:255|unique:courses_category,slug,NULL,id,deleted_at,NULL", 
             "status"     =>  "required|numeric",         
        ]);
       if(!$request->ajax()):
            $store  =   $this->repository->create($request->all()); 
            if($store == null): 
                $request->session()->flash('flash-success-message',$this->createMessage);
                return \Redirect::route('category'); 
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
    public function edit(CoursesCategory $CoursesCategory)
    {
         $page_title="Category";  $active='category'; 
        $breadcrumb = array(   
                                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                array ("title" => 'Category', "url" => $this->defaultUrl ),  
                                array ("title" => 'Edit', "active" => 1,"url" => '' ), //only last add active page array
                                
                           ); 
        return view('admin::category.edit', compact('page_title','active','breadcrumb','CoursesCategory'));
    
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, CoursesCategory $CoursesCategory)
    {
       $request->validate([
            'name'=>'required|max:255',
            'slug'=>   "required|max:255|unique:courses_category,slug,$CoursesCategory->id,id,deleted_at,NULL", 
            "status"     =>  "required|numeric",         
        ]);
        $update = $this->repository->update($request->all(), $CoursesCategory); 
        if($update == null): 
            $request->session()->flash('flash-success-message',$this->updateMessage);
            return \Redirect::route('category'); 
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
    public function destroy(CoursesCategory $CoursesCategory)
    {
        if(\Request::ajax()): 
            $error = $msg = null;
            try{   if($CoursesCategory):  $CoursesCategory->delete(); endif;
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
