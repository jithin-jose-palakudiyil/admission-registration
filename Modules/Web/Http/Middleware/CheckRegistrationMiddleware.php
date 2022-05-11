<?php

namespace Modules\Web\Http\Middleware;

use Closure; use \Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;  
use \App\Helpers\SmsHelper as sms;

class CheckRegistrationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
         $step =  Auth::guard(web_guard)->user()->current_step;
        
         $route = $request->route()->getName();
//         dd($step);
         if($step == "step_1")  :
           //send otp and show view  
            if (!$request->session()->has('refresh_otp')): 
                $otp = rand(1000, 9999); 
                $sms    =  sms::getlead_otp_sms(Auth::guard(web_guard)->user()->mobile,$otp); 
                if($sms): 
                   $array =['otp' =>$otp ,'otp_created_at' => \Illuminate\Support\Carbon::now()];
                   \Modules\Web\Entities\User::find(\Auth::guard(web_guard)->user()->id)->update($array);
                 endif;  
                $request->session()->put('refresh_otp',1);
                $request->session()->save();
            endif;
            Auth::guard(web_guard)->user()->refresh(); 
            if($route != 'register_otp' ):
                return \Redirect::route('register_otp');
            endif;
        elseif($step == "step_2")  :  
            if('personal_info' != $route ):
                return \Redirect::route('personal_info');
            endif; 
        elseif($step == "step_3")  :  
            if('courses_category_step' != $route ):
                return \Redirect::route('courses_category_step');
            endif; 
        elseif($step == "step_4")  :  
            if('courses_accademic_step' != $route ): 
                return \Redirect::route('courses_accademic_step');
            endif; 
              
        elseif($step == "step_5")  :  
//            if('step_5' != $step ):
//                return \Redirect::route('dashboard_web');
//            endif; 
        endif;
        return $next($request);
        
        //return $next($request);
    }
}
