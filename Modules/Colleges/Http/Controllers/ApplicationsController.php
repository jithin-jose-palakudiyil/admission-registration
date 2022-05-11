<?php

namespace Modules\Colleges\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Colleges\Entities\NewApplications;
use \PDF;
class ApplicationsController extends Controller
{
     /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function AllApplications()
    {
        $college_id = \Auth::guard(colleges_guard)->user()->id;
        return \DataTables::of(NewApplications::where('college_id',$college_id)->orderBy('id','desc')->get())->make(true);   
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $page_title="Applications";  $active='applications';
        $breadcrumb = array(   
                                array ("title" => 'Dashboard', "url" => URL(colleges_prefix) ),
                                array ("title" => 'Applications', "active" => 1,"url" => '' ), //only last add active page array
                           ); 
        $CreateBtn = array('url'=>route('clg_download_excel'),'btn_txt'=>'Download Excel');    
        return view('colleges::applications.index', compact('page_title','active','breadcrumb','CreateBtn')); 
    }

    

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $application= NewApplications::with('hasForms')->where('id',$id)->first();
        if($application && isset($application->hasForms->slug) && $application->hasForms->slug !=null): 
            $page_title="Applications";  $active='applications'; 
            $breadcrumb = array(   
                                    array ("title" => 'Dashboard', "url" => URL(colleges_prefix) ),
                                    array ("title" => 'Applications',"url" => route('colleges_applications_index') ),
                                    array ("title" => 'show', "active" => 1,"url" => '' ),
                               );  
            return view('colleges::applications.show', compact('page_title','active','breadcrumb','application'));
        else: abort(404); endif;
    }
  
    public function download_pdf($id, Request $request)
    {
        $application= NewApplications::with('hasForms')->where('id',$id)->first();
        if(!$application):
            $request->session()->flash('flash-error-message',"Application not found");
            return redirect()->back();  
        endif;
        $view_blade = null;
        if($application->hasForms->slug == 'btech-regular'):  
            $view_blade ='colleges::applications.print.btech-regular-print'; 
        elseif($application->hasForms->slug == 'btech-lateral-entry'): 
            $view_blade ='colleges::applications.print.btech-lateral-entry-print';
        elseif($application->hasForms->slug == 'polytechnic-diploma-regular'):   
            $view_blade ='colleges::applications.print.polytechnic-diploma-regular-print'; 
        elseif($application->hasForms->slug == 'polytechnic-diploma-lateral-entry'):    
            $view_blade ='colleges::applications.print.polytechnic-diploma-lateral-entry-print';
        elseif($application->hasForms->slug == 'm-tech'):    
            $view_blade ='colleges::applications.print.m-tech-print';
        elseif($application->hasForms->slug == 'b-pharm-regular'):    
            $view_blade ='colleges::applications.print.b-pharm-regular-print';
        elseif($application->hasForms->slug == 'd-pharm-regular'):    
            $view_blade = 'colleges::applications.print.d-pharm-regular-print'; 
        endif; 
        $created_at =  $application->created_at;            
        if($request->exists('change_created_at') && $request->exists('new_created_date') && $request->exists('new_created_time')):
            if( $request->new_created_date && $request->new_created_time):
                $created_at = $request->new_created_date.' '.$request->new_created_time; 
                $created_at =\Carbon\Carbon::parse($created_at)->format('Y-m-d H:i:s');
            endif; 
        endif;
        $print_my_application = true; 
        $created_at = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $created_at)->format('d-m-Y H:i:s'); 
        return view($view_blade, compact('application','created_at','print_my_application'));
//         $pdf = PDF::loadView($view_blade, ['application'=>$application,'created_at'=>$created_at]);  
//         return $pdf->download('mgm_application_'.$application->id.'.pdf');
    }
    
     public function download_excel(Request $request){
        $college_id = \Auth::guard(colleges_guard)->user()->id;
        $NewApplications = NewApplications::where('college_id',$college_id)->orderBy('id','desc')->get();  
        $view_blade= 'colleges::applications.excel.download_export';

        //    return view($view_blade, compact('userExam'));
            return \Excel::download(new \Modules\Colleges\Exports\ApplicationsExport($NewApplications,$view_blade), 'mgm_applications_'.date("Ymdhisa").'.csv');
      
     }
}
