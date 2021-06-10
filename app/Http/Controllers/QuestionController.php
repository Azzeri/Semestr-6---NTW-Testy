<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;

class QuestionController extends Controller
{
    public function showQuestions()
    {
        if (Auth::check() == true) {
            if (Auth::user()->privilege == 'admin') {

                $questionsData = Question::all();

                return view('showQuestions', ['questionsData' => $questionsData]);
            } else
                echo 'Acces Denied';
        } else
            echo 'Acces Denied';
    }

    public function addQuestionConfirm(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required',
            'ansA' => 'required',
            'ansB' => 'required',
            'ansC' => 'required',
            'ansD' => 'required',
            'ansCorrect' => 'required',
        ]);

        $question = new Question();

        $question->content = $request->input('content');
        $question->ansA = $request->input('ansA');
        $question->ansB = $request->input('ansB');
        $question->ansC = $request->input('ansC');
        $question->ansD = $request->input('ansD');
        $question->ansCorrect = $request->input('ansCorrect');
        $question->save();

        return redirect('showQuestions');
    }
}
