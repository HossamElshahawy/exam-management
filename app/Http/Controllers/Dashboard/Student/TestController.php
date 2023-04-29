<?php

namespace App\Http\Controllers\Dashboard\Student;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\QnaExam;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function index()
    {
        $department = Auth::user()->department;
        $level = Auth::user()->level;

        $exams = Exam::whereHas('subject', function ($query) use ($department, $level) {
            $query->where('department_id', $department->id)
                ->where('level', $level);
        })->get();

        return view('dashboard.student.test.index',compact('exams'));
    }
    public function loadExamDashobard($id)
    {

        $qnaExam = Exam::where('enterance_id',$id)->with('getQnaExam')->get();
            if(count($qnaExam)>0)
            {
                if ($qnaExam[0]['date'] == date('Y-m-d'))
                {
                    if (count($qnaExam[0]['getQnaExam'])>0)
                    {
                        $qna = QnaExam::where('exam_id',$qnaExam[0]['id'])->with('question','answer')->inrandomOrder()->get();

                        return view('dashboard.student.test.exam',['success'=>true,'exam'=>$qnaExam,'qna'=>$qna]);

                    }else
                    {
                        return view('dashboard.student.test.exam',['success'=>false,'msg'=>'This exam Not Available Now','exam'=>$qnaExam]);

                    }
                }elseif($qnaExam[0]['date'] > date('Y-m-d'))
                {
                    return view('dashboard.student.test.exam',['success'=>false,'msg'=>'This exam will be Start on '.$qnaExam[0]['date'],'exam'=>$qnaExam]);
                }else
                {
                    return view('dashboard.student.test.exam',['success'=>false,'msg'=>'This exam has been expired on '.$qnaExam[0]['date'],'exam'=>$qnaExam]);

                }

            }else
            {
                return view('404');
            }

    }
}