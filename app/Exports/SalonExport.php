<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class SalonExport implements FromView
{
    public function __construct($list){
        $this->list=$list;
    }

    public function view():View
    {
        return view('admin.salon.export',['list'=>$this->list]);
    }
}
