<?php

namespace App\Http\Controllers\Dashboard\Professor;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamAttempt;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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

    public function studentMark(Request $request)
    {
        // Get the authenticated teacher's ID
        $teacher_id = auth()->id();

        // Get the subjects taught by the authenticated teacher
        $subjects = Subject::where('user_id', $teacher_id)->pluck('id')->toArray();

        // Get the students who attempted the exams for the teacher's subjects and their marks
        $students = ExamAttempt::whereIn('exam_id', function ($query) use ($subjects) {
            $query->select('id')
                ->from('exams')
                ->whereIn('subject_id', $subjects);
        })
            ->with(['user', 'exam'])
            ->get();

        return view('dashboard.professor.StudentMark.index',compact('students'));
    }
}
