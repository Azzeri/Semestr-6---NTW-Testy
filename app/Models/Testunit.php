<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

$table = "testunit";
class Testunit extends Model
{
    use HasFactory;



    protected $fillable = [
        'student_album',
        'test_id'
    ];

    public function assignedUser()
    {
        return $this->hasOne(Student::class, 'album_student', 'student_album');
    }

    public function assignedTest()
    {
        return $this->belongsTo(Test::class, 'test_id');
    }
}
