<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth; 
use Validator; 
use Redirect;

class AuthController extends Controller
{
    protected $redirectTo = admin_prefix.'/dashboard';
    protected $redirectBack = admin_prefix; 
    
    
     /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if(Auth::guard(admin_guard)->user())  {   return Redirect::to($this->redirectTo);   }
        else   { $page_title= 'Admin'; return view('admin::auth.login', compact('page_title'));} 
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
            $validator = Validator::make($request->all(), [  'email' => 'required',  'password' => 'required', ]);
            if($validator->fails()) {  return Redirect::back()->withErrors($validator);  }
            else
            {
                if (!$request->ajax()) 
                { 
                    // set the remember me cookie if the user check the box
                    $remember = ($request->exists('remember')) ? true : false;  
                    if (Auth::guard(admin_guard)->attempt(['email' => $request->get('email'), 'password' => $request->get('password')], $remember)) 
                    { 
                        if( Auth::guard(admin_guard)->user()->type == 1 || Auth::guard(admin_guard)->user()->type == 0 ):
                            return Redirect::to($this->redirectTo); 
                        else:
                            Auth::guard(admin_guard)->logout();
                            \Session::flush();
                            return Redirect::back()->withErrors(['message' => 'Invalid user, Permission denied!']);
                        endif;
                           
                        
                    }
                    else { return Redirect::back()->withErrors(['message' => 'Invalid email or password. Try again!']);}
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
        Auth::guard(admin_guard)->logout();
        \Session::flush();
        return redirect($this->redirectBack);
    }
    
    
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admin::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('admin::edit');
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
