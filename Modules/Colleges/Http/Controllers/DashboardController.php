<?php

namespace Modules\Colleges\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\UserExam;
use Modules\Admin\Entities\User;
use Exception;
use PDF;


class DashboardController extends Controller
{


    public function __construct()
    {   
        $this->defaultUrl           =   route('colleges_dashboard');
    }


    public function index()
    {
        $page_title="MGM - colleges dashboard";  $active='dashboard';  
        $breadcrumb = array( array ("title" => 'Dashboard', "active" => 1,"url" => $this->defaultUrl ) );
        return view('colleges::dashboard.index', compact('page_title','active','breadcrumb'));
  
    }


}
