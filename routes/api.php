<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Employee;
use App\Models\Department;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/teste',function(){
    return "oi oio ioi oioioo";
});

Route::post('/employees', function (Request $request){
    $employees = new Employee();
    $employees->name = $request->input('name');
    $employees->position = $request->input('position');
    $employees->salary = $request->input('salary' );
    $employees->hire_date = $request->input('hire_date' );
    $employees->department_id = $request->input('department_id');
    $employees->save();
    return response()->json($employees);
});

Route::get('/employees' , function () {
    $employees = Employee::all();
    return response()->json($employees);
});

//buscando funcionários com departamentos 
Route::get('/employees/department', function(){
    $employees = Employee::with('department')->get();
    return response()->json($employees);
});

Route::get('/employees/{id}' , function ($id) {
    $employees = Employee::find($id);
    return response()->json($employees);
});

Route::patch('/employees/{id}', function (Request $request, $id){
    $employees = Employee::find($id);

    if($request->input('name') !== null){
    $employees->name = $request->input('name');
    }
    if($request->input('position') !== null){
    $employees->position= $request->input('position');
    }
    if($request->input('salary') !== null){
    $employees->salary = $request->input('salary');
    }
    if($request->input('hire_date') !== null){
    $employees->hire_date = $request->input('hire_date');
    }
    $employees->save();
    return response()->json($employees);

});

Route::delete('/employees/{id}' , function ($id) {
    $employees = Employee::find($id);
    $employees ->delete();
    return response()->json($employees);
});

Route::post('/departments', function (Request $request){
    $departments = new Department();
    $departments->name = $request->input('name');
    $departments->email = $request->input('email');
    $departments->manager = $request->input('manager');
    $departments->save();
    return response()->json($departments);
});

Route::get('/departments' , function () {
    $departments = Department::all();
    return response()->json($departments);
});

//buscando funcionários com departamentos 
Route::get('/departments/employees', function(){
    $department = Department::with('employees')->get();
    return response()->json($department);
});

Route::get('/departments/{id}' , function ($id) {
    $departments = Department::find($id);
    return response()->json($departments);
});

Route::patch('/departments/{id}', function (Request $request, $id){
    $departments = Department::find($id);

    if($request->input('name') !== null){
    $departments->name = $request->input('name');
    }
    if($request->input('email') !== null){
    $departments->email= $request->input('email');
    }
    if($request->input('manager') !== null){
    $departments->manager = $request->input('manager');
    }
    $departments->save();
    return response()->json($departments);

});

Route::delete('/departments/{id}' , function ($id) {
    $departments = Department::find($id);
    $departments ->delete();
    return response()->json($departments);
});

Route::get('/employees/department/{id}', function($id){
    $employees = Employee::find($id);
    $department = $employees->department;

    return response()->json($department);
});

Route::get('/department/employees/{id}', function($id){
    $department = Department::find($id);
    $employees = $department->employees;

    return response()->json($employees);
});
