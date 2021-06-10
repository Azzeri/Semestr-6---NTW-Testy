<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use App\Models\Student;

class GroupController extends Controller
{
    public function addGroup()
    {
        if (Auth::check() == true) {
            if (Auth::user()->privilege == 'admin') {

                $groupsData = Group::all();

                return view('addGroup', ['groupsData' => $groupsData]);
            } else
                echo 'Acces Denied';
        } else
            echo 'Acces Denied';
    }

    public function addGroupConfirm(Request $task)
    {

        $validated = $task->validate([
            'name' => 'required|unique:App\Models\Group,name',
        ]);

        $group = new Group();

        $group->name = $task->input('name');
        $group->save();


        return redirect('addGroup');
    }

    public function groupDetails($id)
    {
        if (Auth::check() == true) {
            if (Auth::user()->privilege == 'admin') {

                $groupData = Group::find($id);
                $studentsData = Student::all();

                // return view('groupDetails', ['groupData' => $groupData, 'studentsData' => $studentsData]);
                return view('groupDetails', ['groupData' => $groupData, 'studentData'=>$studentsData]);
            } else
                echo 'Acces Denied';
        } else
            echo 'Acces Denied';
    }

    public function addToGroupConfirm(Request $request)
    {
        $validated = $request->validate([
            'album' => 'required',
        ]);

        $albumNumber = $request->input('album');
        $groupId = $request->input('group');

        $student = Student::Where('album_student', $albumNumber)->first();
        $group = Group::Where('id', $groupId)->first();

        $group->studentsInGroup()->attach($student->album_student);
        //$student->groupsOfStudent()->attach($group);

        return redirect('groupDetails' . $group->id);
    }
}
