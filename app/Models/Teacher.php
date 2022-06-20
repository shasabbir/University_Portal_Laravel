<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CourseTeacher;
class Teacher extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table='teachers';
    
    public function courses(){
        return $this->hasMany(CourseTeacher::class,'t_id');
    }
}
