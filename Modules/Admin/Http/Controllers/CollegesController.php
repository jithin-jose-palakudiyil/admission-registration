<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \Modules\Admin\Repositories\CollegesRepository;
use \Modules\Admin\Entities\Colleges;

class CollegesController extends Controller
{
    protected $repository;
     
     public function __construct(Colleges $college)
    {   
        $this->defaultUrl           =   route('colleges');
        $this->createUrl            =   route('colleges.create');  
        $this->createMessage        =   'College is created successfully.';
        $this->createErrorMessage   =   'College is not created successfully.';
        $this->updateMessage        =   'College is updated successfully.';
        $this->updateErrorMessage   =   'College is not updated successfully.';
        $this->deleteMessage        =   'College is deleted successfully.';
        $this->deleteErrorMessage   =   'College is not deleted successfully.';  
        $this->repository           =   new CollegesRepository($college); 
        
       
        
    }
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function AllColleges()
    {
        return \DataTables::of(Colleges::orderBy('id','desc')->get())->make(true);   
    }
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $page_title="Colleges";  $active='colleges';
        $CreateBtn = array('url'=>$this->createUrl,'btn_txt'=>'New College');
        $breadcrumb = array(   
                                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                array ("title" => 'Colleges', "active" => 1,"url" => $this->defaultUrl ), //only last add active page array
                           );  
        return view('admin::colleges.index', compact('page_title','active','breadcrumb','CreateBtn'));
    
        
       
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Colleges $college)
    {
        $page_title="Colleges";  $active='colleges'; 
        $breadcrumb = array(   
                                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                array ("title" => 'Colleges', "url" => $this->defaultUrl ),  
                                array ("title" => 'Create', "active" => 1,"url" => '' ), //only last add active page array
                                
                           ); 
        return view('admin::colleges.create', compact('page_title','active','breadcrumb','college'));
    
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
            'slug'=>   "required|max:255|unique:colleges,slug,NULL,id,deleted_at,NULL",
            'username'=>   "required|max:255|unique:colleges,username,NULL,id,deleted_at,NULL",
            'password'=>   "required|min:6", 
            "status"     =>  "required|numeric",         
        ]);
       if(!$request->ajax()):
            $store  =   $this->repository->create($request->all()); 
            if($store == null): 
                $request->session()->flash('flash-success-message',$this->createMessage);
                return \Redirect::route('colleges'); 
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
    public function edit(Colleges $college)
    {
        $edit = 1;
        $page_title="Colleges";  $active='colleges'; 
        $breadcrumb = array(   
                                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                array ("title" => 'Colleges', "url" => $this->defaultUrl ),  
                                array ("title" => 'Edit', "active" => 1,"url" => '' ), //only last add active page array
                                
                           ); 
        return view('admin::colleges.edit', compact('edit','page_title','active','breadcrumb','college'));
    
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Colleges $college)
    {
        $request->validate([
            'name'=>'required|max:255',
            'slug'=>   "required|max:255|unique:colleges,slug,$college->id,id,deleted_at,NULL", 
            'username'=>   "required|max:255|unique:colleges,username,$college->id,id,deleted_at,NULL", 
            "status"     =>  "required|numeric",     
            'password'=>  ($request->password == null) ? 'required_without:HdnEdit' : "min:6", 
        ]);
        $update = $this->repository->update($request->all(), $college); 
        if($update == null): 
            $request->session()->flash('flash-success-message',$this->updateMessage);
            return \Redirect::route('colleges'); 
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
    public function destroy(Colleges $college)
    { 
        if(\Request::ajax()): 
            $error = $msg = null;
            try{   if($college):  $college->delete(); endif;
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
