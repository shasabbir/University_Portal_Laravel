<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Course;
class CourseStudent extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table='course_students';
    public function course(){
        return $this->belongsTo(Course::class,'c_id');
    }
    public function student(){
        return $this->belongsTo(Student::class,'s_id');
    }
}
