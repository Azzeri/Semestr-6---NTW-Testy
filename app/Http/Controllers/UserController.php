<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showUsers()
    {
        if (Auth::check() == true) {
            if (Auth::user()->privilege == 'admin') {

                $userList = Student::all();

                return view('showUsers', ['userList' => $userList]);
            } else
                echo 'Acces Denied';
        } else
            echo 'Acces Denied';
    }

    public function addUserPage()
    {
        if (Auth::check() == true) {
            if (Auth::user()->privilege == 'admin')
                return view('addUser');
            else
                echo 'Acces Denied';
        } else
            echo 'Acces Denied';
    }

    public function addUserConfirm(Request $task)
    {
        $validated = $task->validate([
            'album' => 'required|unique:App\Models\Student,album_student|min:5|max:5',
            'name' => 'required|min:3|max:128',
            'surname' => 'required|min:3|max:128'

        ]);


        $user = new User;
        $student = new Student;

        //$user->name = $task->input('name');
        $user->email = $task->input('album') . "@uczelnia.pl";
        $user->password = bcrypt('qwerty');
        $user->privilege = 'student';
        $user->save();

        $student->album_student = $task->input('album');
        $student->name = $task->input('name');
        $student->surname = $task->input('surname');
        $student->user_id = $user->id; //IMPORTANT
        $student->save();

        return redirect('showusers');
    }

    public function deleteUser($album)
    {
        $student = Student::where('album_student', $album)->first();
        $user = $student->constraintedUser;
        $user->password = bcrypt('NIEMADOSTEPU');
        $user->active = false;
        $user->save();

        //$aux = $student->user_id;
        // Student::where('album_student', $album)->delete();
        //$user = User::where('id', $aux)->first()->delete();

        return redirect('showusers');
    }

    public function editUser($album)
    {
        $student = Student::where('album_student', $album)->first();
        $user = User::where('id', $student->user_id)->first();
        return view('editUser', ["studentData" => $student, "userData" => $user]);
    }

    public function editUserConfirm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:128',
            'surname' => 'required|min:3|max:128'
        ]);

        //$user = User::where('id', $request->input('userId'))->first();
        //$user->email = $request->input('album') . '@uczelnia.pl';
        //$user->save();

        Student::where('album_student', $request->input('studentAlbum'))
            ->update(['name' => $request->input('name'), 'surname' => $request->input('surname')]);

        return redirect('showusers');
    }

    public function showAdminPanel()
    {
        if (Auth::check() == true) {
            if (Auth::user()->privilege == 'admin') {

                $adminData = User::where('privilege', 'admin')->first();

                return view('adminPanel', ['adminData' => $adminData]);
            } else
                echo 'Acces Denied';
        } else
            echo 'Acces Denied';
    }

    public function changeAdminData(Request $request)
    {

        $validated = $request->validate([
            'oldpass' => 'required',
            'newpass' => 'required|min:6|max:128',
            'confirmpass' => 'required|same:newpass'
        ]);

        if (Hash::check($request->input('oldpass'), Auth::user()->password)) {
            $user = User::where('privilege', 'admin')->first();
            $user->password = bcrypt($request->input('newpass'));
            $user->save();
        }
        return redirect('showAdminPanel');
    }
}
