<?php

namespace Modules\Admin\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersQuizExport implements FromView 
{
 
    public function __construct($userExam,$view_blade)
    {
        $this->userExam = $userExam;
        $this->view_blade = $view_blade;
    }

    
    public function view(): View
    {
        $view_blade = $this->view_blade;
        return view($view_blade, [
            'userExam' => $this->userExam, 
        ]);
    }
    
     
 
 
}
