<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Subject;

class ChapterController extends Controller
{
    public function index()
    {
        $chapters = Chapter::paginate(10);
        $subjects = Subject::all();
        $profsubjects = auth()->user()->subject()->get();

        return view('dashboard.professor.chapter.index',compact('chapters','subjects','profsubjects'));
    }
    public function store(Request $request)
    {
        try
        {
            Chapter::insert([
                'name' => $request->name,
                'description' => $request->description,
                'num_questions'=> $request->num_questions,
                'subject_id' => $request->subject_id,
            ]);
            return response()->json(['success' => true, 'msg' => 'chapter added successfully.']);
        }
        catch (\Illuminate\Database\QueryException $exception)
        {
            return response()->json(['success' => false, 'msg' => $exception->getMessage()]);
        }
    }
    public function edit(string $id)
    {
        try
        {
            $chapter= Chapter::Where('id',$id)->get();
            return response()->json(['success' => true, 'data'=>$chapter]);
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
            $chapter = Chapter::findOrFail($request->chapter_id);
            $chapter->name = $request->name;
            $chapter->description = $request->description;
            $chapter->num_questions = $request->num_questions;
            $chapter->subject_id = $request->subject_id;
            $chapter->save();

            return response()->json(['success' => true, 'msg' => 'Chapter updated successfully.']);

        } catch (\Illuminate\Database\QueryException $exception) {
            return response()->json(['success' => false, 'msg' => $exception->getMessage()]);
        }
    }
    public function destroy(Request $request)
    {
        try {
            Chapter::where('id',$request->id)->delete();
            return response()->json(['success' => true, 'msg' => 'Chapter deleted successfully.']);

        } catch (\Illuminate\Database\QueryException $exception) {
            return response()->json(['success' => false, 'msg' => $exception->getMessage()]);
        }
    }
}
