<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'album_student',
        'name',
        'surname',
        'user_id',
    ];
    protected $primaryKey = 'album_student';//IMPORTANT!

    public function constraintedUser(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function constraintedTest(){
        return $this->belongsTo(Testunit::class);
    }

    public function groupsOfStudent(){       

        return $this->belongsToMany(Group::class,'student_group','student_album','group_id');
        //return $this->belongsToMany(Student::class,'student_group','group_id','student_album');
    }
}
