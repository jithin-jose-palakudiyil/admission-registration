<?php

namespace Modules\Web\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \Modules\Web\Http\Requests\PersonalInfoRequest;
use Modules\Web\Entities\User;
use \Auth;
use Session;


class PersonalInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $active = 'personal-info';
        $page_title = "MGM - Add Personal details";
        return view('web::wizard.steps.personal_details_step1', compact('page_title', 'active'));
    }

    public function store(PersonalInfoRequest $request){

        $error = null;
        $user =  \Auth::guard(web_guard)->user();
        
        $data = [
            'gender' => $request->gender,
            'address' => $request->address,
            'district' => $request->district,
            'pincode' => $request->pin,
            'date_of_birth' => $request->date_of_birth,
            'caste_category' =>  $request->caste_category,
            'caste_category_other' => $request->caste_category == "Other" ? $request->caste_category_other : null ,
            'mobile' => $request->mobile,
            'whatsapp' => $request->whatsapp,
            'parent_name' => $request->parent_name,
            'parent_contact' => $request->parent_contact,
//            'class_completed' => $request->class_completed,
//            'last_studied' => $request->last_studied,
//            'board' =>  $request->board,
//            'board_other' => $request->board == "Other" ? $request->board_other : null ,
//            'annual_income' => $request->annual_income,
            'current_step' => 'step_3',
//            'tenth_mark' => $request->tenth_mark,
//            'tenth_board' => $request->tenth_board,
//            'tenth_maximum_mark' => $request->tenth_maximum_mark,
//            'plus_one_mark' => $request->plus_one_mark,
//            'plus_one_board' => $request->plus_one_board,
//            'plus_one_maximum_mark' => $request->plus_one_maximum_mark,
             
        ];
//        dd($request->all());
//            $allowedfileExtension = ['jpg','png','jpeg','JPG','PNG','JPEG'];
//            $path = public_path().'/uploads/users/'.$user->id;
//            if($request->exists('tenth_mark_list') && $request->tenth_mark_list !=null ): 
//                $tenth_mark_list = \App\Helpers\FileHelper::upload($request->tenth_mark_list, $path, $allowedfileExtension);
//                $data['tenth_mark_list'] = '/uploads/users/'.$user->id.'/'.$tenth_mark_list['file_name'];
//            endif;
//            if($request->exists('plus_one_mark_list') && $request->plus_one_mark_list !=null ): 
//                $plus_one_mark_list = \App\Helpers\FileHelper::upload($request->plus_one_mark_list, $path, $allowedfileExtension);
//                $data['plus_one_mark_list'] = '/uploads/users/'.$user->id.'/'.$plus_one_mark_list['file_name'];
//            endif;
//            
//            if($request->exists('plus_two_mark_list') && $request->plus_two_mark_list !=null ): 
//                $plus_two_mark_list = \App\Helpers\FileHelper::upload($request->plus_two_mark_list, $path, $allowedfileExtension);
//                $data['plus_two_mark_list'] = '/uploads/users/'.$user->id.'/'.$plus_two_mark_list['file_name'];
//            endif;
            
            
            
        if($user->current_step == "step_5"): 
            if(isset($data['current_step'])): unset($data['current_step']); endif;
        endif;
        if($user):
            try{

                User::where('id', $user->id)->update($data);
            }catch(Exception $ex){$error = $ex->getMessage();}
            if($error == null):
                if($user->current_step == "step_5"): 
                    $request->session()->flash('flash-success-message', 'Updated Successfully!');
                    return redirect()->route('dashboard_web');
                else:
                    return redirect()->route('courses_category_step');
                endif;
            else:
                $request->session()->flash('store_error', 'Sorry ! something went wrong please try again.');
                return \Redirect::back(); 
            endif;
        else:
            return redirect()->route('loginView');
        endif;
    
    }
}
