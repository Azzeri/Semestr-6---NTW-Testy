<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Test;
use App\Models\Question;
use App\Models\Student;
use App\Models\Group;
use App\Models\Testunit;

class TestController extends Controller
{
    public function showTestToSolve($id)
    {
        $testUnitData = Testunit::find($id);
        $testData = $testUnitData->assignedTest;
        $questionsData = $testData->questionsInTest;

        return view('testToSolve', ['testUnit' => $testUnitData, 'testData' => $testData, 'questionsData' => $questionsData]);
    }

    public function showTestToSolveValidate(Request $request)
    {
        $data = $request->except('_token', 'testunit');
        $points = 0;
        $pointsMax = 0;
        $test = Testunit::find($request->input('testunit'));
        $feedback = null;

        foreach ($data as $key => $value) {
            $question = Question::find($key);
            $pointsMax++;
            if ($value == $question->ansCorrect)
                $points++;
            else {
                $feedback[$question->content] = [$value, $question->ansCorrect];
            }
        }

        $test->finished = 1;
        $test->result = $points;
        $test->save();

        return view('testResults', ['points' => $points, 'feedback' => $feedback, 'pointsMax' => $pointsMax]);
    }

    public function showTests()
    {
        if (Auth::check() == true) {
            if (Auth::user()->privilege == 'admin') {

                $testsData = Test::all();

                return view('showTests', ['testsData' => $testsData]);
            } else
                echo 'Acces Denied';
        } else
            echo 'Acces Denied';
    }

    public function showStudentTests()
    {
        if (Auth::check() == true) {
            if (Auth::user()->privilege == 'student') {

                $album = trim(Auth::user()->email, "@uczelnia.pl");
                $testsUnitData = Testunit::where('student_album', $album)->get();

                return view('usertestsPanel', ['testsUnitData' => $testsUnitData]);
            } else
                echo 'Acces Denied';
        } else
            echo 'Acces Denied';
    }

    public function addTestConfirm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $test = new Test();

        $test->name = $request->input('name');
        $test->save();

        return redirect('showTests');
    }

    public function testDetails($id)
    {
        if (Auth::check() == true) {
            if (Auth::user()->privilege == 'admin') {
                $testData = Test::find($id);
                $questionData = Question::all();
                $studentData = Student::all();
                $groupData = Group::all();
                $testUnitData = Testunit::where('test_id', $id)->get();

                return view('testDetails', ['testUnitData' => $testUnitData, 'testData' => $testData, 'questionData' => $questionData, 'studentData' => $studentData, 'groupData' => $groupData]);
            } else
                echo 'Acces Denied';
        } else
            echo 'Acces Denied';
    }

    public function addQuestionToTestConfirm(Request $request)
    {
        $testId = $request->input('test_id');
        $questionId = $request->input('question');

        $test = Test::find($testId);
        $question = Question::find($questionId);

        $test->questionsInTest()->attach($question);

        return redirect('testDetails' . $test->id);
    }

    public function assignStudentToTest(Request $request)
    {
        $studentId = $request->input('student');
        $testId = $request->input('test_id');

        $testUnit = new Testunit();
        $test = Test::find($testId);
        $student = Student::where('album_student', $studentId)->first();

        $testUnit->student_album = $student->album_student;
        $testUnit->test_id = $test->id;

        $testUnit->save();

        return redirect('testDetails' . $test->id);
    }

    public function assignGroupToTest(Request $request)
    {
        $groupId = $request->input('group');
        $testId = $request->input('test_id');

        $test = Test::find($testId);
        $group = Group::find($groupId);
        $testUnits = Testunit::all();
        $flaga = false;

        foreach ($group->studentsInGroup as $student) {
            if ($student->constraintedUser->active == true) {
                foreach ($testUnits as $testUnit) {
                    if ($testUnit->student_album == $student->album_student && $testUnit->test_id == $test->id) {
                        $flaga = true;
                        break;
                    } else {
                        $flaga = false;
                    }
                }
                if ($flaga == false) {
                    $testUnit = new Testunit();
                    $testUnit->student_album = $student->album_student;
                    $testUnit->test_id = $test->id;

                    $testUnit->save();
                    $flaga = false;
                }
            }
        }

        return redirect('testDetails' . $test->id);
    }
}
