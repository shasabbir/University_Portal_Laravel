<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $primaryKey='id';
    public $incrementing = true;
    protected $keyType='int';
    protected $table='notes';
    public function course(){
        return $this->belongsTo(Course::class,'c_id');
    }
}
