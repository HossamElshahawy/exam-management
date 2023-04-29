<?php

namespace App\Http\Controllers\Dashboard\professor;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QnAController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::with('answers')->get();
        return view('dashboard.professor.QnA.index',compact('questions'));
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
           $questionId = Question::insertGetId([
            'question' => $request->question
           ]);

           foreach($request->answer as $answer)
           {
            $is_correct =0;
            if($request->is_correct == $answer)
            {
                $is_correct = 1;

            }
            Answer::insert([
                'question_id'=>$questionId,
                'answer'=>$answer,
                'is_correct'=>$is_correct
            ]);

           }

            return response()->json(['success' => true, 'msg' => 'QnA added successfully.']);
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
    public function edit(Request $request)
    {
        $question = Question::where('id', $request->qid)->with('answers')->get();
        return response()->json(['data' => $question]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try
        {
            Question::where('id',$request->question_id)->update([
                'question'=> $request->question
            ]);

            // old answer update
            if(isset($request->answer))
            {
                foreach ($request->answer as $key => $value)
                {
                    $is_correct = 0;
                    if ($request->is_correct == $value)
                    {
                        $is_correct = 1;
                    }
                    Answer::where('id',$key)->update([
                        'question_id'=>$request->question_id,
                        'answer'=>$value,
                        'is_correct'=>$is_correct
                    ]);

                }
            }

            // new answer added
            if(isset($request->new_answers))
            {
                foreach ($request->new_answers as $answer)
                {
                    $is_correct = 0;
                    if ($request->is_correct == $answer)
                    {
                        $is_correct = 1;
                    }
                    Answer::insert([
                        'question_id'=>$request->question_id,
                        'answer'=>$answer,
                        'is_correct'=>$is_correct
                    ]);

                }
            }
            return response()->json(['success' => true, 'msg' => 'QnA updated successfully.']);

        }
        catch (\Illuminate\Database\QueryException $exception)
        {
            return response()->json(['success' => false, 'msg' => $exception->getMessage()]);
        }



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Answer::where('id',$request->id)->delete();
        return response()->json(['success' =>true,'msg'=>'Answer deleted successfully!']);

    }
    public function deleteQnA(Request $request)
    {
        Question::where('id',$request->id)->delete();
        Answer::where('question_id',$request->id)->delete();
        return response()->json(['success' =>true,'msg'=>'Q&A deleted successfully!']);

    }
}
