<?php

namespace Modules\Web\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \Modules\Web\Entities\CoursesCategory;
use \Modules\Web\Entities\Colleges;
use \Modules\Web\Entities\Courses;
use \Modules\Web\Entities\AssignCategoryCollege;
use \Modules\Web\Entities\AssignColleges;


class CoursesCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $page_title = "MGM - Programs";
        $CoursesCategoryAll = CoursesCategory::where('status', 1)->get();
        $CoursesCategory = [];
        foreach ($CoursesCategoryAll as $key => $value){
            $checkIfCollegeAssigned = \Modules\Web\Entities\AssignColleges::where('courses_category_id', $value->id)->first();
            $checkIfCategoryCollegeAssigned = \Modules\Web\Entities\AssignCategoryCollege::where('courses_category_id', $value->id)->first();
            if($checkIfCollegeAssigned && $checkIfCategoryCollegeAssigned):
                array_push($CoursesCategory, $value);
            endif;
        }
        return view('web::wizard.steps.courses_category_step2', compact('page_title', 'CoursesCategory'));
    }

    public function store(Request $request)
    {   
//        $request->validate([ 'courses_category' => 'array ']);
        $request->validate([ 'courses_category' => 'required|numeric']);

        if(!isset($request->courses_category)){
            $request->session()->flash('store_error', 'You must select atleast one program !');
            return redirect()->back();
        }
        $courses_category = $request->courses_category;
        return redirect()->route('courses_colleges_step', ['courses_category_array' => \Crypt::encryptString(json_encode($courses_category)) ]);
    }
}



// public function store(Request $request)
// {   
//     $request->validate([ 'courses_category' => 'array ']);

//     if(!isset($request->courses_category)){
//         $request->session()->flash('store_error', 'You must select atleast one program !');
//         return redirect()->back();
//     }
//     $colleges = [];
//     foreach($request->courses_category as $key => $value){
//         $collegess = AssignColleges::with('GetColleges')->where('courses_category_id', $value)->get();
//         foreach($collegess as $collegessKey => $collegessValue){

//             array_push($colleges, $collegess);
//         }
//     }
//     dd($colleges);
//     return redirect()->route('courses_colleges_step', ['colleges_array' => \Crypt::encryptString(json_encode($colleges)) ]);
// }
