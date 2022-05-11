<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Forms;
use \Modules\Admin\Entities\Colleges;
use \Exception;

class FormsController extends Controller
{
     /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function AllForms()
    {
        return \DataTables::of(Forms::orderBy('id','desc')->get())->make(true);   
    }
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
     {
        $page_title="Forms";  $active='forms'; 
        $breadcrumb = array(   
                                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                array ("title" => 'Forms', "active" => 1,"url" => route('forms') ), //only last add active page array
                           );  
        return view('admin::forms.index', compact('page_title','active','breadcrumb'));
    
        
       
    }
 

    /**
     * Store a newly created resource in storage.
     * @param $college int
     * @return Renderable
     */
    public function assign_forms(Colleges $college)
    {
        $forms =Forms::all();
        $page_title="Form Assign";  $active='colleges'; 
        $breadcrumb = array(   
                                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                array ("title" => 'Colleges', "url" => route('colleges') ), //only last add active page array
                                array ("title" => 'Form Assign', "active" => 1,"url" => '' ), //only last add active page array
                           );  
        return view('admin::forms.assign', compact('page_title','active','breadcrumb','forms','college'));
    
    }

   

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function assign_forms_store(Request $request, Colleges $college)
    {
//        $request->validate(['assign'=>'required|array|min:1']);  
        $error=null;
        if(!empty($request->assign)):
            try
            {   
                $databaseName = \Config::get('database.connections');
                \Modules\Admin\Entities\PivotFormsCollege::where('college_id',$college->id)->delete();
                foreach ($request->assign as $key => $value) :
                    $array=[];
                    $table = \DB::select("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '".$databaseName['mysql']['database']."' AND TABLE_NAME = 'pivot_forms_college'");
                    if (!empty($table)) :
                        $array['form_id']=$value;
                        $array['college_id']=$college->id;
                        $array['forms_college_id']=$college->id.'-'.$table[0]->AUTO_INCREMENT;
                        \Modules\Admin\Entities\PivotFormsCollege::insert($array);
                    endif; 
                endforeach;
            } catch (Exception $ex) { $error = $ex->getMessage();}
            if($error==null):
                $request->session()->flash('flash-success-message','Sucessfully updated');
            else:
                $request->session()->flash('flash-error-message','Error occured<br/>'.$error);
            endif;
            return \Redirect::back(); 
        else:
            \Modules\Admin\Entities\PivotFormsCollege::where('college_id',$college->id)->delete();
            $request->session()->flash('flash-success-message','Sucessfully removed all forms');
            return \Redirect::route('colleges');
        endif;
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
