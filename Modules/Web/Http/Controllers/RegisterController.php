<?php

namespace Modules\Web\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Helpers\SmsHelper as sms;
use Modules\Web\Entities\User;
use \Exception; use \Auth;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $page_title = "MGM - Register";
        return view('web::auth.register', compact('page_title'));
       
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

        $request->validate (  [ 
            'name' =>  'required|max:225',
            'email'     =>  'required|unique:users,email,NULL,id,deleted_at,NULL|max:255',
            'mobile'    =>  'required|unique:users,mobile,NULL,id,deleted_at,NULL|max:255',
            'password' =>'required|max:225|min:8',
            'confirm_password' =>'required|max:225',
         ] );
        $otp = rand(1000, 9999); $error=null;   
        $register_array = [ 'name' => $request->name, 'otp' => $otp, 'email' => $request->email, 'mobile' => str_replace(' ', '', $request->mobile), 'password' => bcrypt($request->password),'is_otp_verified'=>1,'otp' => null, 'is_otp_sent'=> null, 'otp_updated_at' =>null, 'otp_created_at'=>null, 'current_step'=>'step_2' ]; 
        
//        if($register): 
            try{ 
//                $register = 
                        User::create($register_array);
//                \Auth::guard(web_guard)->attempt(['email' => $request->email, 'password' => $request->password]); // make student logged in                
//                $sms    =  sms::getlead_otp_sms(Auth::guard(web_guard)->user()->mobile,Auth::guard(web_guard)->user()->otp);
//                if($sms): 
//                   $array =['is_otp_sent' =>1 ,'otp_created_at' => \Illuminate\Support\Carbon::now()];
//                   User::find(Auth::guard(web_guard)->user()->id)->update($array);  //update db
//                endif;  
//                $request->session()->put('refresh_otp',1); 
            } catch (Exception $ex) { $error = $ex->getMessage();  }
            if($error == null):
                   return \Redirect::to(route('personal_info')); 
//                 return redirect()->route('register_otp'); 
            else:
                $request->session()->flash('register_error', 'Sorry something went wrong please try again.');
                return \Redirect::back();  
            endif;
            
//        else:
            $request->session()->flash('register_error', 'Sorry something went wrong please try again.');
            return \Redirect::back(); 
//        endif;
    }

    public function otp_resend()
    {
        $user = \Auth::guard(web_guard)->user();
            if(\Request::ajax() ):  
            $otp = rand(1000, 9999); 
            $sms    = \App\Helpers\SmsHelper::getlead_otp_sms($user->mobile,$otp); 
            if($sms): 
                $array =['otp' =>$otp ,'otp_updated_at' =>\Illuminate\Support\Carbon::now() ,'otp_created_at' => \Illuminate\Support\Carbon::now()];
                \Modules\Web\Entities\User::find($user->id)->update($array);  //update db 
               return response()->json(['status'=>true,'resend_msg' =>'<div style="color: #23bfa1;font-weight: 400;font-size: 13px;margin:  0px;padding: 0px;">OTP resend successfullty to +91 '.$user->mobile .'<div><br/>'], 200);
            else:
                return response()->json(['status'=>FALSE,'resend_msg' =>'<div style="color: #f0643b;font-weight: 400;font-size: 13px;margin:  0px;padding: 0px;">OTP resend failed !<div><br/>'], 200);
            endif;   
        else: abort(404); endif;
    }

}
