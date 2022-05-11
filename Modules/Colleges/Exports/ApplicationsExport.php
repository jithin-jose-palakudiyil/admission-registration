<?php

namespace Modules\Colleges\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ApplicationsExport implements FromView 
{
 
    public function __construct($applications,$view_blade)
    {
        $this->applications = $applications;
        $this->view_blade = $view_blade;
    }

    
    public function view(): View
    {
        $view_blade = $this->view_blade;
        return view($view_blade, [
            'applications' => $this->applications, 
        ]);
    }
    
     
 
 
}
