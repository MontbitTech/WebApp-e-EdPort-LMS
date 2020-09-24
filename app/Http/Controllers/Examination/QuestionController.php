<?php

namespace App\Http\Controllers\Examination;

use App\Http\Controllers\Controller;
use App\Models\Examination\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index (Request $request)
    {
        $questions = Question::with('subject');

        foreach ( $request->all() as $key => $value ) {
            $questions = $questions->where($key, $value);
        }

        return $questions->get();
    }

    public function show (Request $request, $id)
    {
        return Question::find($id);
    }

    public function store (Request $request)
    {
        $question = new Question();

        foreach ( $request->all() as $key => $value ) {
            $question->$key = $value;
        }
        $question->save();

        return $question;
    }

    public function destroy (Request $request, $id)
    {
        Question::find($id)->delete();
    }
}
