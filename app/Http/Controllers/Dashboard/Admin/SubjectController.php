<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Subject;
use App\Models\Department;
use App\Models\User;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::paginate(10);
        $departments = Department::all();
        $users = User::where('role',1)->get();

        return view('dashboard.admin.subject.index',compact('subjects','departments','users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try
        {
            Subject::insert([
                'name' => $request->name,
                'level'=> $request->level,
                'department_id'=> $request->department_id,
                'user_id'=> $request->user_id,
            ]);
            return response()->json(['success' => true, 'msg' => 'Subject added successfully.']);
        }
        catch (\Illuminate\Database\QueryException $exception)
        {
            return response()->json(['success' => false, 'msg' => $exception->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try
        {
            $subject= Subject::Where('id',$id)->get();
            return response()->json(['success' => true, 'data'=>$subject]);
        }
        catch (\Illuminate\Database\QueryException $exception)
        {
            return response()->json(['success' => false, 'msg' => $exception->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $subject = Subject::findOrFail($request->subject_id);
            $subject->name = $request->name;
            $subject->level = $request->level;
            $subject->department_id = $request->department_id;
            $subject->user_id = $request->user_id;

            $subject->save();

            return response()->json(['success' => true, 'msg' => 'Department updated successfully.']);

        } catch (\Illuminate\Database\QueryException $exception) {
            return response()->json(['success' => false, 'msg' => $exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            Subject::where('id',$request->id)->delete();
            return response()->json(['success' => true, 'msg' => 'Subject deleted successfully.']);

        } catch (\Illuminate\Database\QueryException $exception) {
            return response()->json(['success' => false, 'msg' => $exception->getMessage()]);
        }
    }
}
