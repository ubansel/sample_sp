<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentHomework extends Model
{
    use HasFactory;

    public function student()
    {
        $this->belongsTo(Student::class, 'id', 'student_id');
    }

    public function graded_by()
    {
        $this->hasOne(Teacher::class, 'id', 'grading_teacher_id');
    }
}
