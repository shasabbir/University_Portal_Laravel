<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\TeacherNotice;
use App\Models\AdminsNotice;
use App\Models\Note;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Validator;

use Illuminate\Support\Facades\Mail;
use App\Mail\noteOTP;
use App\Mail\noticeOTP;
class TeacherApiController extends Controller
{
    public function index(Request $req){
        $teacher=Teacher::where('id','=',$req->id)->first();
        if(!$teacher){
            return response()->json(["msg"=>"no teacher with this id"],500);
         }
         $cc= $teacher->courses->count();
        $arr=array();
        for ($i=0;$i<$cc;$i++){
        $arr[]=$teacher->courses[$i]->course;
        }
         return response()->json(["id"=>$teacher->id,"name"=>$teacher->name,"password"=>$teacher->password,"dob"=>$teacher->dob,"address"=>$teacher->address,"designation"=>$teacher->designation,"bg"=>$teacher->bg,"courses"=>$teacher->courses],200);
         
        //return $teacher;
    }
    public function profileedit(Request $req){
        $id=$req->id;
        $teacher=Teacher::where('id','=',$id)->first();
        try {

            if(!$teacher){
                return response()->json(["msg"=>"no teacher with this id"],500);
             }
            $teacher->name=$req->name;
            $teacher->address=$req->address;
            //$teacher->save();
            if($teacher->save()){
                return response()->json(["msg"=>"edited"],200);
             }
          
          } catch (\Exception $e) {
            return response()->json(["msg"=>$e->getMessage()],500);
          }
    }
    public function courses(Request $req){
        $id=$req->id;
        $teacher=Teacher::where('id','=',$req->id)->first();
        $cc= $teacher->courses->count();
        $arr=array();
        for ($i=0;$i<$cc;$i++){
        $arr[]=$teacher->courses[$i]->course;
        }
        return $arr;

    }
    
    public function course(Request $req){
    try {
        $course=Course::where('id','=',$req->id)->first();
        //return $course->students;
        $cs= $course->students->count();
        $sts=array();
        for ($i=0;$i<$cs;$i++){
        $sts[]=$course->students[$i]->student;
        }
        $s= json_decode($course->schedule);
        if(!$course){
            return response()->json(["msg"=>"no course with this id"],500);
         }
         return response()->json(["id"=>$course->id,"name"=>$course->name,"schedule"=>$s,"students"=>$course->students],200);
        } catch (\Exception $e) {
            return response()->json(["msg"=>$e->getMessage()],500);
          }
    }


    public function anotices(){
        $anotices=AdminsNotice::all();
        if(!$anotices){
            return response()->json(["msg"=>"no notice"],500);
         }
        return response()->json(["notices"=>$anotices],200);
    }

    public function coursenotice(Request $req){
        $course=Course::where('id','=',$req->id)->first();
        //return $course->notices;
        return response()->json(["notices"=>$course->notices,"cid"=>$req->id],200);
        
    }

    public function noticeadd(Request $req){
       
        $notice= new TeacherNotice();
        $course=Course::where('id','=',$req->c_id)->first();
        try {
            $notice->headline =$req->headline;
        $notice->whole =$req->whole;
        $notice->c_id=$req->c_id;

        $cs= $course->students->count();
        $sts=array();
        for ($i=0;$i<$cs;$i++){
        $sts[]=$course->students[$i]->student->email;
        }
        //$stu=$notice->course->students->email;//[0]->student;
        //return response()->json(["msg"=>$sts],200);
            if($notice->save()){ 
                //$emails =  ['a@a.com', 'b@b.com'];
            Mail::to($sts)->send(new noticeOTP());
                return response()->json(["msg"=>"added"],200);
             }
          
          } catch (\Exception $e) {
            return response()->json(["msg"=>$e->getMessage()],500);
          }
    }

    
    public function noticeedit(Request $req){
        try {
        $notice=TeacherNotice::where('id','=',$req->id)->first();
        $notice->headline=$req->headline;
        $notice->whole=$req->whole;
        if($notice->save()){
            return response()->json(["msg"=>"edited"],200);
         }
    } catch (\Exception $e) {
        return response()->json(["msg"=>$e->getMessage()],500);
      }
        
    }


    public function coursenote(Request $req){
        $course=Course::where('id','=',$req->id)->first();
        return response()->json(["notes"=>$course->notes,"cid"=>$req->id],200);
    }

    public function coursenoticedel(Request $req){
        //$dn=
        //TeacherNotice::where('id', $req->id)->delete();
        if(TeacherNotice::where('id', $req->id)->delete()){
            return response()->json(["msg"=>"deleted"],200);
         }
        
    }

    public function noteadd(Request $req){
       try{ $validator = Validator::make($req->all(),
            [
                'name'=>'required'
            ],
            [
                'name.required'=>'You must put your note name'
            ]
        );
        if($validator->fails()) {          
            
            return response()->json([$validator->errors()], 500);                        
         } 
         $course=Course::where('id','=',$req->id)->first();
         $cs= $course->students->count();
         $sts=array();
         for ($i=0;$i<$cs;$i++){
         $sts[]=$course->students[$i]->student->email;
         } 
        $folder="notes";
        $f_name=$req->name.".".$req->file('note')->getClientOriginalExtension();
        $directory=$req->file('note')->storeAs($folder,$f_name);
        $note= new Note();
        $note->name =$req->name;
        $note->directory =$directory;
        $note->c_id=$req->id;
        if($note->save()){
            //Mail::to($sts)->send(new noteOTP());
            return response()->json(['msg'=>"added"], 200);  
            
        }
    } catch (\Exception $e) {
        return response()->json(["msg"=>$e->getMessage()],500);
      }
    }

    

    public function coursenotedel(Request $req)
    {
       try{ $note=Note::where('id','=',$req->id)->first();
    Storage::delete($note->directory);
    if(Note::where('id', $req->id)->delete()){
        return response()->json(['msg'=>"deleted"], 200);  
    }
} catch (\Exception $e) {
    return response()->json(["msg"=>$e->getMessage()],500);
  }
    }



    public function logincheck(Request $req){
       $teacher=Teacher::where('id','=',$req->id)
        ->where('id','=',$req->password)
        ->first();
        if($teacher){
            return response()->json(['msg'=>"ok"], 200); 
        }
        return response()->json(['msg'=>"notok"], 200); 
        //$student=Student::where('id','=',$id)->first();
        //return view('teacher.student')->with('student',$student);
    }

    public function registration(Request $req){
        try{ $validator = Validator::make($req->all(),
             [
                 'name'=>'required'
             ],
             [
                 'name.required'=>'You must put your note name'
             ]
         );
         if($validator->fails()) {          
             
             return response()->json(['error'=>$validator->errors()], 500);                        
          }  
         
         $teacher= new Teacher();
         $teacher->id =$req->id;
         $teacher->name =$req->name;
         $teacher->password =$req->password;
         $teacher->dob =$req->dob;
         $teacher->propic ="demo";
         $teacher->address =$req->address;
         $teacher->designation =$req->designation;
         $teacher->bg =$req->bg;
         
         if($teacher->save()){
             //Mail::to('info@laravel.io')->send(new noteOTP());
             return response()->json(['msg'=>"added"], 200);  
             
         }
     } catch (\Exception $e) {
         return response()->json(["msg"=>$e->getMessage()],500);
       }
     }
    
}
