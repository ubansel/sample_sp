<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    public function homeworks()
    {
        return $this->hasMany(Homework::class, 'teacher_id', 'id');
    }

    public function grades()
    {
        return $this->hasMany(StudentHomework::class, 'graded_teacher_id', 'id');
    }
}
