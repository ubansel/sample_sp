<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function homeworks()
    {
        return $this->hasMany(StudentHomework::class, 'student_id', 'id');
    }
}
