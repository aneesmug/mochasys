<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Page extends BaseController
{
    public function index()
    {
        return view('login');
    }
    
    public function customer_register()
    {
        return view('customer_register');
    }
    public function employee_register()
    {
        return view('employee/emp_register');
    }
    // public function applyVac()
    // {
    //     return view('vacation_register');
    // }
}
