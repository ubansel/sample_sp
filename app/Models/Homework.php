<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    use HasFactory;

    public function studentHomeworks()
    {
        return $this->hasMany(StudentHomework::class, 'homework_id', 'id');
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'id', 'teacher_id');
    }
}
