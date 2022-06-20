<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use App\Models\CourseStudent;
use App\Models\CourseTeacher;
use App\Models\TeacherNotice;
class Course extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table='courses';
    public function department(){
        return $this->belongsTo(Department::class,'d_id');
    }
    public function students(){
        return $this->hasMany(CourseStudent::class,'c_id');
    }
    
    public function courses(){
        return $this->hasMany(CourseTeacher::class,'c_id');
    }
    public function notes(){
        return $this->hasMany(Note::class,'c_id');
    }
    public function notices(){
        return $this->hasMany(TeacherNotice::class,'c_id');
    }
}
