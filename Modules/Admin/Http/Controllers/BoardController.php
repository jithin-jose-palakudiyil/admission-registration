<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Board;
use Modules\Admin\Repositories\BoardRepository;

class BoardController extends Controller
{
    protected $repository;
     
    public function __construct(Board $board)
    {   
        $this->defaultUrl           =   route('board');
        $this->createUrl            =   route('board.create');  
        $this->createMessage        =   'Board is created successfully.';
        $this->createErrorMessage   =   'Board is not created successfully.';
        $this->updateMessage        =   'Board is updated successfully.';
        $this->updateErrorMessage   =   'Board is not updated successfully.';
        $this->deleteMessage        =   'Board is deleted successfully.';
        $this->deleteErrorMessage   =   'Board is not deleted successfully.';  
        $this->repository           =   new BoardRepository($board);    
    }
    
     /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function AllBoard()
    {
        return \DataTables::of(Board::orderBy('id','desc')->get())->make(true);   
    }
    
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
       $page_title="Board";  $active='board';
        $CreateBtn = array('url'=>$this->createUrl,'btn_txt'=>'New Board');
        $breadcrumb = array(   
                                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                array ("title" => 'Board', "active" => 1,"url" => $this->defaultUrl ), //only last add active page array
                           );  
        return view('admin::board.index', compact('page_title','active','breadcrumb','CreateBtn'));
    
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Board $board)
    {
          $page_title="Board";  $active='board'; 
        $breadcrumb = array(   
                                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                array ("title" => 'Board', "url" => $this->defaultUrl ),  
                                array ("title" => 'Create', "active" => 1,"url" => '' ), //only last add active page array
                                
                           ); 
        return view('admin::board.create', compact('page_title','active','breadcrumb','board'));
    
       
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
            'board_type'=>'required|numeric',  
             'slug'=>'required|max:255',
//            'slug'=>   "required|max:255|unique:board,slug,NULL,id,deleted_at,NULL", 
        ]);
        if(!$request->ajax()):
            $store  =   $this->repository->create($request->all()); 
            if($store == null): 
                $request->session()->flash('flash-success-message',$this->createMessage);
                return \Redirect::route('board'); 
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
    public function edit(Board $board)
    {
      
        $page_title="Board";  $active='board'; 
        $breadcrumb = array(   
                                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                array ("title" => 'Board', "url" => $this->defaultUrl ),  
                                array ("title" => 'Edit', "active" => 1,"url" => '' ), //only last add active page array
                                
                           ); 
        return view('admin::board.edit', compact('page_title','active','breadcrumb','board'));
    
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Board $board)
    {
          $request->validate([
            'name'=>'required|max:255',  
               'board_type'=>'required|numeric',
              'slug'=>'required|max:255',
//             'slug'=>   "required|max:255|unique:courses_category,slug,$board->id,id,deleted_at,NULL", 
       
        ]);
         $update = $this->repository->update($request->all(), $board); 
        if($update == null): 
            $request->session()->flash('flash-success-message',$this->updateMessage);
            return \Redirect::route('board'); 
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
    public function destroy(Board $board)
    {
          if(\Request::ajax()): 
            $error = $msg = null;
            try{   if($board):  $board->delete(); endif;
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
