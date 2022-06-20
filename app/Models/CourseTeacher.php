<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
class CourseTeacher extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table='teacher_courses';
    public function course(){
        return $this->belongsTo(Course::class,'c_id');
    }
}
