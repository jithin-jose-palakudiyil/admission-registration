<?php

namespace Modules\Web\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \Auth; use \Exception;
class AcademicsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $active = 'academics'; 
        $page_title = "MGM - Academics";
        return view('web::wizard.steps.academics_details_step4', compact('page_title', 'active'));
    
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('web::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'tenth_board'=>'required',
            'tenth_passing_year'=>'required|numeric',
            'tenth_register_number'=>'required|numeric',
            'tenth_marks'=>'required|numeric',
            "tenth_mark_list"     => 'required_without:hidden_tenth_marks|mimes:jpg,png,jpeg,JPG,PNG,JPEG||max:6000', // max 6mb, 
            "mark_list_plus_two"     => 'mimes:jpg,png,jpeg,JPG,PNG,JPEG||max:6000' // max 6mb, 
        ]);
        
            $data = $request->all();
            $user = Auth::guard(web_guard)->user();
            $allowedfileExtension = ['jpg','png','jpeg','JPG','PNG','JPEG'];
            $path = public_path().'/uploads/users/'.$user->id;
            
            if($request->exists('tenth_mark_list') && $request->tenth_mark_list !=null ): 
                $tenth_mark_list = \App\Helpers\FileHelper::upload($request->tenth_mark_list, $path, $allowedfileExtension);
                $data['tenth_mark_list'] = '/uploads/users/'.$user->id.'/'.$tenth_mark_list['file_name'];
            endif;
            
            if($request->exists('mark_list_plus_two') && $request->mark_list_plus_two !=null ): 
                $plus_two_mark_list = \App\Helpers\FileHelper::upload($request->mark_list_plus_two, $path, $allowedfileExtension);
                $data['mark_list_plus_two'] = '/uploads/users/'.$user->id.'/'.$plus_two_mark_list['file_name'];
            endif;
            $data['current_step']='step_5';
            if(isset($data['_token'])):unset($data['_token']);endif;
            if(isset($data['HiddenCheck'])):unset($data['HiddenCheck']);endif;
            if(isset($data['hidden_tenth_marks'])):unset($data['hidden_tenth_marks']);endif;
            
            $error= null;
            try
            {
                if($user->current_step == "step_5"): 
                    if(isset($data['current_step'])): unset($data['current_step']); endif;
                endif;
                if(!isset($data['entrance_exam'])):
                    $data['entrance_exam'] = null;
                    $data['entrance_name'] = null;
                    $data['entrance_rank'] = null;
                    $data['entrance_result_waiting'] = null; 
                    $data['entrance_name_1'] = null;
                    $data['entrance_rank_1'] = null;
                    $data['entrance_result_waiting_1'] = null; 
                endif; 
                if(isset($data['entrance_result_waiting']) && $data['entrance_result_waiting']==1):
                    $data['entrance_rank'] = null;
                endif;
                
                if(isset($data['entrance_result_waiting_1']) && $data['entrance_result_waiting_1']==1):
                    $data['entrance_rank_1'] = null;
                endif;
                \Modules\Web\Entities\User::where('id', $user->id)->update($data);
            } catch (Exception $ex) { $error=$ex->getMessage(); } 
            if($error == null):
                $request->session()->flash('flash-success-message', 'Updated Successfully!');
                return redirect()->route('dashboard_web');
            else:
                $request->session()->flash('store_error', 'Sorry something went wrong !');
                return redirect()->back();
            endif;
         
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('web::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('web::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
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
