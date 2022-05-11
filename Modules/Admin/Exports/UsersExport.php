<?php

namespace Modules\Admin\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromView 
{
 
    public function __construct($users,$view_blade)
    {
        $this->users = $users;
        $this->view_blade = $view_blade;
    }

    
    public function view(): View
    {
        $view_blade = $this->view_blade;
        return view($view_blade, [
            'users' => $this->users, 
        ]);
    }
    
     
 
 
}
