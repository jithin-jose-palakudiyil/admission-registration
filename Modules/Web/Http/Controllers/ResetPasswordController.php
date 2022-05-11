<?php

namespace Modules\Web\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \Auth; 
use Session;
use Illuminate\Support\Facades\Crypt;
use Exception;
use Str;


class ResetPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $page_title = 'MGM - Reset Password';
        return view('web::auth.forgot', compact('page_title'));
    }



    public function SendOtp(Request $request)
    {
        $request->validate(['mobile'=> 'required|numeric']);
        $user = \Modules\Web\Entities\User::where('mobile', $request->mobile)->first();

            if($user):
                $otp = rand(1000, 9999); 
                $sms    = \App\Helpers\SmsHelper::getlead_otp_sms($user->mobile,$otp); 
                if($sms): 
                   $array =['reset_otp' =>$otp ,'reset_otp_updated_at' =>\Illuminate\Support\Carbon::now() ,'reset_otp_created_at' => \Illuminate\Support\Carbon::now()];
                   $user->update($array);  //update db 
                    $encrypted_mobile =  Crypt::encryptString($user->mobile);
                    Session::put('user_forgot_id', $user->id);
                    return redirect()->route('forgot_otp');
                else:
                    $request->session()->flash('reset-error', 'Sorry ! otp could not be sent');
                    return redirect()->route('forgot');
                endif;   
            else:
                $request->session()->flash('reset-error', 'Sorry ! User not found. Please Register first');
                return redirect()->back();
            endif;

    }


    public function OtpIndex()
    {
        $page_title = 'MGM - Reset Password';
        $id =  Session::get('user_forgot_id');
        $user = \Modules\Web\Entities\User::where('id', $id)->first();
        return view('web::auth.reset_otp', compact('user', 'page_title'));
    }


    public function forgotOtpVerify($user_id, Request $request)
    {
        $request->validate([ 'otp' => 'required|numeric' ]); 
        $user_id = Crypt::decryptString($user_id);
        $user = \Modules\Web\Entities\User::where('id', $user_id)->first();
        if($user->reset_otp == trim($request->otp)):
            $array =['reset_otp' =>null ,'reset_otp_updated_at' =>null ,'reset_otp_created_at' => null, 'reset_token' => Str::random(100).$user->id, 'reset_token_created_at' => \Illuminate\Support\Carbon::now(), 'reset_token_updated_at' => \Illuminate\Support\Carbon::now()];
            $user->update($array); //update db
            // $encrypted_id =  Crypt::encryptString($user->id);
            return \Redirect::route('resetView'); 
        else:
            $request->session()->flash('reset-error', 'Sorry ! Otp does not match');
            $encrypted_mobile =  Crypt::encryptString($user->mobile);
            return redirect()->route('forgot_otp');
        endif;

    }


    public function ResetView(Request $request)
    {
        $page_title = 'MGM - Update Password';
        $id =  Session::get('user_forgot_id');        
        $user = \Modules\Web\Entities\User::where('id', $id)->first();
        if($user && $user->reset_token_created_at!=null):
            $reset_token_created_at = $user->reset_token_created_at;
            $date = \Illuminate\Support\Carbon::parse($reset_token_created_at);
            $now = \Illuminate\Support\Carbon::now();
            $diff = $date->diffInMinutes($now);
            if(isset($diff)):
                if($diff<2 && $user->reset_token!=null):
                    return view('web::auth.reset', compact('page_title'));
                else:
                    $request->session()->flash('reset-error', 'Session expired !');
                    return redirect()->route('loginView');
                endif;
            endif;
        else:
            $request->session()->flash('reset-error', 'Session expired !');
            return redirect()->route('loginView');
        endif;
    }


    public function UpdatePassword(Request $request)
    {
        $request->validate([ 'password' => 'required' ]); 
        $error = null;
        $id =  Session::get('user_forgot_id');        
        $user = \Modules\Web\Entities\User::where('id', $id)->first();
        if($user):
                if($user->reset_token!=null):
                    try{
                        $data = [
                            'password' => bcrypt($request->password),
                            'reset_token' => null, 
                            'reset_token_created_at' => null, 
                            'reset_token_updated_at' => null

                        ];
                        $user->update($data);
                    }catch(Exception $e){$error = $e->getMessage();}
                else:
                    $request->session()->flash('reset-error', 'Session expired !');
                    return redirect()->route('loginView');
                endif;
            if($error == null):
                $request->session()->flash('reset-success', 'Password updated successfully !');
                return redirect()->route('loginView');
            else:   
                $request->session()->flash('reset-error', 'Sorry ! Password could not be updated ');
                return \Redirect::route('resetView'); 
            endif;
        else:
            $request->session()->flash('reset-error', 'User not found !');
            return redirect()->route('loginView');
        endif;


    }


    public function otp_resend()
    {
        $id =  Session::get('user_forgot_id');        
        $user = \Modules\Web\Entities\User::where('id', $id)->first();
            if(\Request::ajax() ):  
            $otp = rand(1000, 9999); 
            $sms    = \App\Helpers\SmsHelper::getlead_otp_sms($user->mobile,$otp); 
            if($sms): 
                $array =['reset_otp' =>$otp ,'reset_otp_updated_at' =>\Illuminate\Support\Carbon::now() ,'reset_otp_created_at' => \Illuminate\Support\Carbon::now()];
                \Modules\Web\Entities\User::find($user->id)->update($array);  //update db 
               return response()->json(['status'=>true,'resend_msg' =>'<div style="color: #23bfa1;font-weight: 400;font-size: 13px;margin:  0px;padding: 0px;">OTP resent successfully to +91 '.$user->mobile .'<div><br/>'], 200);
            else:
                return response()->json(['status'=>FALSE,'resend_msg' =>'<div style="color: #f0643b;font-weight: 400;font-size: 13px;margin:  0px;padding: 0px;">OTP resend failed ! <div><br/>'], 200);
            endif;   
        else: abort(404); endif;
    }



   
}
