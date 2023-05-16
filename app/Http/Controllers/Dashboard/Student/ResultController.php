<?php

namespace App\Http\Controllers\Dashboard\Student;

use App\Http\Controllers\Controller;
use App\Models\ExamAnswer;
use App\Models\ExamAttempt;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
        $results = ExamAttempt::with('exam')->where('user_id',auth()->user()->id)->get();
        return view('dashboard.student.test.result',compact('results'));
    }
    public function getReviewQnA(Request $request)
    {
        try {
            $attemptData = ExamAnswer::where('attempt_id',$request->attempt_id)->with(['question','answer'])->get();

            return response()->json(['success' => true, 'msg' => 'Q&A Data !','data'=>$attemptData]);
        } catch (\Illuminate\Database\QueryException $exception) {
            return response()->json(['success' => false, 'msg' => $exception->getMessage()]);
        }
    }
}
