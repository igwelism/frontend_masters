<?php

namespace App\Http\Controllers\Auth\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController as BaseController;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends BaseController
{
    protected $redirectTo = '/admin/home';

    public function __construct()
    {
        $this->middleware('guest:employee')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login.employee');
    }

    public function username()
    {
        return 'employee_id';
    }

    protected function guard()
    {
        return Auth::guard('employee');
    }
}
