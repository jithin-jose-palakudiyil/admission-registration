<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\CollegeCategory;
use Modules\Admin\Repositories\CollegeCategoryRepository;


class CollegeCategoryController extends Controller
{
    protected $repository;
     
    public function __construct(CollegeCategory $CollegeCategory)
    {   
        $this->defaultUrl           =   route('college-category');
        $this->createUrl            =   route('college-category.create');  
        $this->createMessage        =   'College category is created successfully.';
        $this->createErrorMessage   =   'College category is not created successfully.';
        $this->updateMessage        =   'College category is updated successfully.';
        $this->updateErrorMessage   =   'College category is not updated successfully.';
        $this->deleteMessage        =   'College category is deleted successfully.';
        $this->deleteErrorMessage   =   'College category is not deleted successfully.';  
        $this->repository           =   new CollegeCategoryRepository($CollegeCategory); 
     
    }
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function AllCollegeCategory()
    {
        return \DataTables::of(CollegeCategory::orderBy('id','desc')->get())->make(true);   
    }
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $page_title="College Category";  $active='college-category';
        $CreateBtn = array('url'=>$this->createUrl,'btn_txt'=>'New College Category');
        $breadcrumb = array(   
                                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                array ("title" => 'College Category', "active" => 1,"url" => $this->defaultUrl ), //only last add active page array
                           );  
        return view('admin::colleges.category.index', compact('page_title','active','breadcrumb','CreateBtn'));
     
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(CollegeCategory $CollegeCategory)
    {
        $page_title="College Category";  $active='college-category'; 
        $breadcrumb = array(   
                                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                array ("title" => 'College Category', "url" => $this->defaultUrl ),  
                                array ("title" => 'Create', "active" => 1,"url" => '' ), //only last add active page array
                                
                           ); 
        return view('admin::colleges.category.create', compact('page_title','active','breadcrumb','CollegeCategory'));
    
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
            'slug'=>   "required|max:255|unique:college_category,slug,NULL,id,deleted_at,NULL", 
             "status"     =>  "required|numeric",         
        ]);
       if(!$request->ajax()):
            $store  =   $this->repository->create($request->all()); 
            if($store == null): 
                $request->session()->flash('flash-success-message',$this->createMessage);
                return \Redirect::route('college-category'); 
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
    public function edit(CollegeCategory $CollegeCategory)
    {
        $page_title="College Category";  $active='college-category'; 
        $breadcrumb = array(   
                                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                array ("title" => 'College Category', "url" => $this->defaultUrl ),  
                                array ("title" => 'Edit', "active" => 1,"url" => '' ), //only last add active page array
                                
                           ); 
        return view('admin::colleges.category.edit', compact('page_title','active','breadcrumb','CollegeCategory'));
    
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, CollegeCategory $CollegeCategory)
    {
        $request->validate([
            'name'=>'required|max:255',
            'slug'=>   "required|max:255|unique:courses_category,slug,$CollegeCategory->id,id,deleted_at,NULL", 
            "status"     =>  "required|numeric",         
        ]);
        $update = $this->repository->update($request->all(), $CollegeCategory); 
        if($update == null): 
            $request->session()->flash('flash-success-message',$this->updateMessage);
            return \Redirect::route('college-category'); 
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
    public function destroy(CollegeCategory $CollegeCategory)
    {
        if(\Request::ajax()): 
            $error = $msg = null;
            try{   if($CollegeCategory):  $CollegeCategory->delete(); endif;
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
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function assign_view(CollegeCategory $CollegeCategory)
    {
        $page_title="Assign ";  $active='college-category'; $AssignColleges=[];
        $breadcrumb = array(   
                             array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                             array ("title" => 'College Category',"url" => route('college-category') ), //only last add active page array
                             array ("title" => 'Assign College and Category', "active" => 1,"url" => route('assign_college_category_list',$CollegeCategory->id) ), //only last add active page array
                        ); 
        $AssignColleges = \Modules\Admin\Entities\AssignCollegeCategory::where('category_id',$CollegeCategory->id)->get();
        if($AssignColleges->isNotEmpty()):
           $AssignColleges=  $AssignColleges->pluck('course_category_id')->unique()->toArray();
        else:$AssignColleges=[]; endif; 
        $CoursesCategory = \Modules\Admin\Entities\CoursesCategory::where('status',1)->get(); 
        return view('admin::colleges.category.assign.index', compact('page_title','active','breadcrumb','CollegeCategory','CoursesCategory','AssignColleges'));
       
    }
    
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function assign_update(Request $request,CollegeCategory $CollegeCategory)
    {
        $error = null; $insert =[];$i=0;
        try 
        {
            $assign = $request->assign;  
            foreach ($assign as $key => $value) : 
                $insert[$i]['category_id']=$CollegeCategory->id;
                $insert[$i]['course_category_id']=$value;
                $i++;
            endforeach; 
            
            \Modules\Admin\Entities\AssignCollegeCategory::where('category_id',$CollegeCategory->id)->delete();
            \Modules\Admin\Entities\AssignCollegeCategory::insert($insert); 
        } catch (Exception $ex) { $error = $ex->getMessage(); }
        if($error == null): 
            $request->session()->flash('flash-success-message',$this->updateMessage);
            return \Redirect::route('college-category'); 
        else: 
            $request->session()->flash('flash-error-message',$this->updateErrorMessage.'<br/> '.$error);
            return \Redirect::back();
        endif;
    }
}
