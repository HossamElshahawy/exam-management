<?php

namespace App\Http\Controllers\Dashboard\Professor;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MarkController extends Controller
{
    public function index()
    {
        $exams = Exam::with('getQnaExam')->get();
        return view('dashboard.professor.exam.marks',compact('exams'));
    }

    public function update(Request $request)
    {
        try {
           Exam::where('id',$request->exam_id)->update([
                'mark' =>$request->mark
           ]);

            return response()->json(['success' => true, 'msg' => 'Mark updated successfully.']);

        } catch (\Illuminate\Database\QueryException $exception) {
            return response()->json(['success' => false, 'msg' => $exception->getMessage()]);
        }
    }

}
