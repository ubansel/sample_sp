<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_homeworks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students');
            $table->foreignId('homework_id')->constrained('homeworks');
            $table->foreignId('grading_teacher_id')->constrained('teachers');
            $table->integer('final_grade')->nullable();
            $table->dateTimeTz('submission_datetime')->nullable();
            $table->dateTimeTz('grade_datetime')->nullable();
            $table->string('teacher_note')->nullable();
            $table->string('filepathname')->nullable();
            $table->timestamps();
            $table->index(['student_id','final_grade']);
            $table->index(['grading_teacher_id','homework_id','final_grade']);
            $table->unique(['student_id', 'homework_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_homeworks');
    }
};
