<?php

namespace App\Http\Controllers\Examination;

use App\Http\Controllers\Controller;
use App\Models\Examination\Question;
use Illuminate\Http\Request;
use Response;
use Validator;


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

        $validator = Validator::make($request->all(), [
            'question'   => 'required',
            'answer'     => 'required',
            'options.*'  => 'required',
            'class'      => 'required',
            'subject_id' => 'required',
            'chapter'    => 'required',
            'topic'      => 'required',
        ],[

            'class.required'      => 'Select Class',
            'subject_id.required' => 'Select Subject',
            'chapter.required'    => 'Select Chapter',
            'topic.required'      => 'Select Topic',
            'options.0.required'  => 'Option 1 is required',    
            'options.1.required'  => 'Option 2 is required',
            'options.2.required'  => 'Option 3 is required', 
            'options.3.required'  => 'Option 4 is required',
            'answer.required'     => 'Checked atleast one correct answer', 
         ]);

        if ($validator->passes()) {
        $question = new Question();
        $question->question = $request->question;
        $question->options = $request->options;
        $question->answer = implode(',', $request->answer);
        $question->type_of_question = count($request->answer) <= 1 ? 'single_choice' : 'multiple_choice';

        $question->class = $request->class;
        $question->subject_id = $request->subject_id;
        $question->chapter = $request->chapter;
        $question->topic = $request->topic;
        $question->save();
    
        return Response::json(['success' => true, 'response' => $question]);
    }
    else{
        return response()->json(['error'=>true, 'response'=>$validator->errors()]);
    }
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
