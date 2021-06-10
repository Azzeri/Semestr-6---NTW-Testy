<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function questionsInTest(){
        return $this->belongsToMany(Question::class,'test_question');
    }

    /*public function studentsInTest(){
        return $this->belongsToMany(Question::class,'test_question');
        return $this->belongsToMany(Student::class,'student_test','test_id','student_album');
    }*/
}
