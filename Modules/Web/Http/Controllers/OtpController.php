<?php

namespace Modules\Web\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \Auth; 
use Session;

class OtpController extends Controller
{

    public function index()
    {
        return view('web::auth.otp');
    }

    public function verify(Request $request)
    {
        $request->validate([ 'otp' => 'required|numeric' ]); 
        if(Auth::guard(web_guard)->user()->otp == trim($request->otp)):
            $array =['is_otp_verified'=>1,'otp' => null, 'is_otp_sent'=> null, 'otp_updated_at' =>null, 'otp_created_at'=>null, 'current_step'=>'step_2',];
            \Modules\Web\Entities\User::find(Auth::guard(web_guard)->user()->id)->update($array); //update db
            Auth::guard(web_guard)->user()->refresh(); 
            // $to = route('users_dashboard');
            // if(\Session::has('user_redirect_plan')):  
            //     $to = \Session::get('user_redirect_plan');
            //     \Session::forget('user_redirect_plan');
            // endif;
            // if(\Session::has('user_redirect_profile')):  
            //     $to = \Session::get('user_redirect_profile');
            //     \Session::forget('user_redirect_profile');
            // endif;
            // if(Session::has('rating_edit')):
            //     Session::forget('rating_edit');
            //   endif;
            return \Redirect::to(route('personal_info')); 
        else:
            return \Redirect::back()->withErrors(['otp' => 'Invalid OTP. Try again!'])->withInput();
        endif;
    }
   
}
