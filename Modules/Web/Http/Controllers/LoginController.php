<?php

namespace Modules\Web\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \Auth;
use Session;

class LoginController extends Controller
{
   public function store(Request $request)
   {
    $request->validate (  [ 'email' =>'required|email','password' =>'required|min:8' ] );
    if (!$request->ajax()) :
        $email = str_replace(' ', '', $request->email);
        $remember = ($request->exists('remember')) ? true : false;
        if (Auth::guard(web_guard)->attempt(['email' => $email, 'password' => $request->password], $remember)):
            return redirect()->route('dashboard_web');
        else: 
            $request->session()->flash('login_error', 'Invalid email or password. Try again!');
            return \Redirect::back();
        endif; 
    else:
        return response()->json(['message' => 'Page not found!'], 404);
    endif;
   }



   public function logout()
   { 
       Auth::guard(web_guard)->logout();
       \Session::flush();
       $url = URL('/');
       return \Redirect::to($url); 
   } 



}
