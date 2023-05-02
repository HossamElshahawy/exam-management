<?php

namespace App\Http\Controllers\Dashboard\professor;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\QnaExam;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::all();
        $subjects = Subject::all();
        $profsubjects = auth()->user()->subject()->get();
        return view('dashboard.professor.exam.index', compact('exams', 'subjects', 'profsubjects'));
    }

    public function create()
    {
        //
    }
    public function show($id)
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $unique_id = uniqid('exid');
            Exam::insert([
                'name' => $request->name,
                'date' => $request->date,
                'time' => $request->time,
//                'level' => $request->level,
                'enterance_id' => $unique_id,

                'attempt' => $request->attempt,
                'subject_id' => $request->subject_id,
            ]);
            return response()->json(['success' => true, 'msg' => 'Exam added successfully.']);
        } catch (\Illuminate\Database\QueryException $exception) {
            return response()->json(['success' => false, 'msg' => $exception->getMessage()]);
        }
    }

    public function edit(string $id)
    {
        try {
            $exam = Exam::Where('id', $id)->get();
            return response()->json(['success' => true, 'data' => $exam]);
        } catch (\Illuminate\Database\QueryException $exception) {
            return response()->json(['success' => false, 'msg' => $exception->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $exam = exam::findOrFail($request->exam_id);
            $exam->name = $request->name;
            $exam->date = $request->date;
            $exam->time = $request->time;
//            $exam->level = $request->level;

            $exam->attempt = $request->attempt;

            $exam->subject_id = $request->subject_id;

            $exam->save();

            return response()->json(['success' => true, 'msg' => 'Exam updated successfully.']);

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
            Exam::where('id', $request->id)->delete();
            return response()->json(['success' => true, 'msg' => 'Exam deleted successfully.']);

        } catch (\Illuminate\Database\QueryException $exception) {
            return response()->json(['success' => false, 'msg' => $exception->getMessage()]);
        }
    }

    public function getQuestions(Request $request)
    {
        try {
            $questions = Question::all();
            if (count($questions) > 0) {
                $data = [];
                $counter = 0;
                foreach ($questions as $question) {
                    $qnaExam = QnaExam::where(['exam_id' => $request->exam_id, 'question_id' => $question->id])->get();
                    if (count($qnaExam) == 0) {
                        $data[$counter]['id'] = $question->id;
                        $data[$counter]['question'] = $question->question;
                        $counter++;
                    }
                }
                return response()->json(['success' => true, 'msg' => 'Question Data!', 'data' => $data]);
            } else {
                return response()->json(['success' => false, 'msg' => 'Question Not Found']);
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return response()->json(['success' => false, 'msg' => $exception->getMessage()]);
        }

    }

    public function addQuestions(Request $request)
    {
        try {
            if (isset($request->questions_ids)) {
                foreach ($request->questions_ids as $qid) {
                    QnaExam::insert([
                        'exam_id' => $request->exam_id,
                        'question_id' => $qid
                    ]);

                }
            }
            return response()->json(['success' => true, 'msg' => 'added successfuly']);

        } catch (\Illuminate\Database\QueryException $exception) {
            return response()->json(['success' => false, 'msg' => $exception->getMessage()]);
        }
    }
    public function showExamQuestions(Request $request)
    {
        try {

            $data = QnaExam::where('exam_id',$request->exam_id)->with('question')->get();
            return response()->json(['success' => true, 'msg' => 'Question Details','data'=>$data]);
        } catch (\Illuminate\Database\QueryException $exception) {
            return response()->json(['success' => false, 'msg' => $exception->getMessage()]);
        }
    }
    public function deleteExamQuestions(Request $request)
    {
        try {

            QnaExam::where('id',$request->id)->delete();
            return response()->json(['success' => true, 'msg' => 'Question Deleted!']);
        } catch (\Illuminate\Database\QueryException $exception) {
            return response()->json(['success' => false, 'msg' => $exception->getMessage()]);
        }
    }



}
