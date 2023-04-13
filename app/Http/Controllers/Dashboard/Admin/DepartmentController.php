<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Department;
use App\Models\Faculity;


class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::paginate(10);
        $faculities = Faculity::all();
        return view('dashboard.admin.department.index',compact('departments','faculities'));
    }
    public function store(Request $request)
    {
        try
        {
            Department::insert([
                'name' => $request->name,
                'faculity_id' => $request->faculity_id,
            ]);
            return response()->json(['success' => true, 'msg' => 'Record added successfully.']);
        }
        catch (\Illuminate\Database\QueryException $exception)
        {
            return response()->json(['success' => false, 'msg' => $exception->getMessage()]);
        }
    }
    public function edit($id)
    {
        try
        {
            $department= Department::Where('id',$id)->get();
            return response()->json(['success' => true, 'data'=>$department]);
        }
        catch (\Illuminate\Database\QueryException $exception)
        {
            return response()->json(['success' => false, 'msg' => $exception->getMessage()]);
        }
    }
    public function update(Request $request)
    {
        try {
            $department = Department::findOrFail($request->department_id);
            $department->name = $request->name;
            $department->faculity_id = $request->faculity_id;
            $department->save();

            return response()->json(['success' => true, 'msg' => 'Department updated successfully.']);

        } catch (\Illuminate\Database\QueryException $exception) {
            return response()->json(['success' => false, 'msg' => $exception->getMessage()]);
        }
    }
    public function destroy(Request $request)
    {
        try {
            Department::where('id',$request->id)->delete();
            return response()->json(['success' => true, 'msg' => 'Department deleted successfully.']);

        } catch (\Illuminate\Database\QueryException $exception) {
            return response()->json(['success' => false, 'msg' => $exception->getMessage()]);
        }
    }
}
