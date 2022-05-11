<?php

namespace Modules\Colleges\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth; 
use Validator; 
use Redirect;

class AuthController extends Controller
{
    protected $redirectTo = colleges_prefix.'/dashboard';
    protected $redirectBack = colleges_prefix; 
    
    
     /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
         
        if(Auth::guard(colleges_guard)->user())  {  return Redirect::to($this->redirectTo);   }
        else   { $page_title= 'Colleges'; return view('colleges::auth.login', compact('page_title'));} 
    }
    
       /**
     * Login Action For Admin Users.
     * @param Request $request
     * @return Response
     */
    public function LoginAction(Request $request)
    {
        if ($request->isMethod('post')) 
        {
            $validator = Validator::make($request->all(), [  'username' => 'required',  'password' => 'required', ]);
            if($validator->fails()) {  return Redirect::back()->withErrors($validator);  }
            else
            {
                if (!$request->ajax()) 
                { 
                    // set the remember me cookie if the user check the box
                    $remember = ($request->exists('remember')) ? true : false;  
                    if (Auth::guard(colleges_guard)->attempt(['username' => $request->get('username'), 'password' => $request->get('password')], $remember)) 
                    { 
                        if( Auth::guard(colleges_guard)->user()->type == 1 || Auth::guard(colleges_guard)->user()->type == 0 ):
                            return Redirect::to($this->redirectTo); 
                        else:
                            Auth::guard(colleges_guard)->logout();
                            \Session::flush();
                            return Redirect::back()->withErrors(['message' => 'Invalid user, Permission denied!']);
                        endif;
                           
                        
                    }
                    else { return Redirect::back()->withErrors(['message' => 'Invalid schoolme or password. Try again!']);}
                } else { return response()->json(['message' => 'Page not found!'], 404);  }
            }
        }
        else{return Redirect::to($this->redirectBack);  }
    }
    
    /**
     * logout Admin
     * @return redirect
     */
    public function logout()
    { 
        Auth::guard(colleges_guard)->logout();
        \Session::flush();
        return redirect($this->redirectBack);
    }
    
      
     
 
}
