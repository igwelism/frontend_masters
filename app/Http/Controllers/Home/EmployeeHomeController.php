<?php

namespace App\Http\Controllers\Home;

use App\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class EmployeeHomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    public function index()
    {
        return view('home.employee');
    }

    public function create(Request $request): JsonResponse
    {
        $request->validate([
        'name' => 'required|string|max:255',
        "id" => 'required|string',
        "email" => 'required|string|email|max:255|unique:users',
        "password" => 'required|string|confirmed|min:6',
        ]);

        $employee = Employee::create([
            'employee_id' => $request->id,
            'fullname' => $request->name,
            'email' => $request->email,
            'employee_password' => Hash::make($request->password),
        ]);
        return response()->json($employee);
    }


    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect('/admin_registration')->with('success', "Employee has been deleted");
    }
}
