<?php

namespace App\Http\Controllers\Examination;

use App\Http\Controllers\Controller;
use App\Models\Examination\Question;
use Illuminate\Http\Request;
use Response;

class QuestionController extends Controller
{
    public function index (Request $request)
    {
        $questions = Question::with('subject');

        foreach ( $request->all() as $key => $value ) {
            if ( $value != null )
                $questions = $questions->where($key, $value);
        }

        return Response::json(['success' => true, 'response' => $questions->get()]);
    }

    public function show (Request $request, $id)
    {
        return Question::find($id);
    }

    public function store (Request $request)
    {
        $question = new Question();
        $question->question = $request->question;
        $question->options = json_encode($request->options);
        $question->answer = implode(',', $request->answer);
        $question->type_of_question = count($request->answer) <= 1 ? 'single_choice' : 'multiple_choice';

        $question->class = $request->class;
        $question->subject_id = $request->subject_id;
        $question->chapter = $request->chapter;
        $question->topic = $request->topic;

        $question->save();

        return Response::json(['success' => true, 'response' => $question]);
    }

    public function destroy (Request $request, $id)
    {
        $question = Question::find($id);

        if ( !$question )
            return Response::json(['success' => true, 'response' => 'Invalid Question']);

        $question->delete();

        return Response::json(['success' => true, 'response' => 'deleted successfully']);
    }
}
