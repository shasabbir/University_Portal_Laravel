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

class TeacherController extends Controller
{
    //
    
    
    public function index(){ 
        $id=session()->get('teacherid');
        $teacher=Teacher::where('id','=',$id)->first();
        //return json_decode($teacher->courses[1]->course->schedule)[1]->day;
        //return $jstr[0]->day;
        return view('teacher.index')->with('t',$teacher);
    }public function profile(){
        $id=session()->get('teacherid');
        $teacher=Teacher::where('id','=',$id)->first();
        return view('teacher.profile')->with('t',$teacher);
    }
    public function profileedit(Request $req){
        $id=session()->get('teacherid');
        $teacher=Teacher::where('id','=',$id)->first();
        return view('teacher.profileedit')->with('teacher',$teacher);
        
    }
    public function profileeditc(Request $req){
        $id=session()->get('teacherid');
        $teacher=Teacher::where('id','=',$id)->first();
        $teacher->name=$req->name;
        $teacher->address=$req->address;
        $teacher->save();
        //$idd= $teacher->course->id;
        return redirect()->route('teacher.profile');
        //return view('teacher.course')->with('id',3);
        
    }

    public function courses(Request $req){
        $id=session()->get('teacherid');
        $teacher=Teacher::where('id','=',$id)->first();
        return view('teacher.courses')->with('t',$teacher);
        //$course=Course::where('id','=',decrypt($req->id))->first();
        //return $course->students[0]->student;
        //return view('teacher.course')->with('course',$course);
    }
    public function anotices(){
        $anotices=AdminsNotice::all();
        return view('teacher.anotices')->with('anotices',$anotices);
    }
    public function course(Request $req){
        $course=Course::where('id','=',$req->id)->first();
        //return $course->students[0]->student;
        return view('teacher.course')->with('course',$course);
    }
    
    public function coursenotice(Request $req){
        $course=Course::where('id','=',$req->id)->first();
        //return $course->notices;
        return view('teacher.coursenotice')
        ->with('cid',$req->id)
        ->with('notices',$course->notices);
    }
    public function coursenote(Request $req){
        $course=Course::where('id','=',$req->id)->first();
        //return $course->notes;
        return view('teacher.coursenote')
        ->with('cid',$req->id)
        ->with('notes',$course->notes);
    }
    public function student($id){
        $student=Student::where('id','=',$id)->first();
        return view('teacher.student')->with('student',$student);
    }
    public function login(){
        return view('teacher.login');
    }
    public function logincheck(Request $req){
        $req->validate(
            [
                'id'=>'required|min:4|max:10',
                'password'=>'required|min:4'
            ],
            [
                'id.required'=>'You must put your id',
                'id.min'=>'Too short id',
                'id.max'=>'Too big id',
                'password.required'=>'You must put your password',
                'password.min'=>'Too short password'
            ]
        );
        $teacher=Teacher::where('id','=',$req->id)
        ->where('id','=',$req->password)
        ->first();
        if($teacher){
            //return $teacher->name;
            //return "ok";
            $req->session()->put('teacherid',$req->id);
        }
        else{
            //return "not ok";
            $req->session()->flash('message','Does not exist');
            
        return redirect()->back();
        }
        return redirect()->route('teacher.index');
        //$student=Student::where('id','=',$id)->first();
        //return view('teacher.student')->with('student',$student);
    }
    
    public function coursenoticeadd(Request $req){
        return view('teacher.coursenoticeadd')->with('id',$req->id);
        
    }
    public function coursenoticedel(Request $req){
        //$dn=
        TeacherNotice::where('id', $req->id)->delete();
        return redirect()->route('teacher.coursenotice', ['id' => $req->cid]);
        
    }
    public function noticeaddcheck(Request $req){
        $req->validate(
            [
                'headline'=>'required',
                'whole'=>'required'
            ],
            [
                'headline.required'=>'You must put your headline',
                'whole.required'=>'You must put your text'
            ]
        );
        $notice= new TeacherNotice();
        $notice->headline =$req->headline;
        $notice->whole =$req->whole;
        $notice->c_id=$req->id;
        $notice->save();
        return redirect()->route('teacher.coursenotice', ['id' => $req->id]);
        //return view('teacher.login');
    }

    public function noticeedit(Request $req){
        $notice=TeacherNotice::where('id','=',$req->id)->first();
        return view('teacher.coursenoticeedit')->with('notice',$notice);
        
    }
    public function noticeeditc(Request $req){
        $notice=TeacherNotice::where('id','=',$req->id)->first();
        $notice->headline=$req->headline;
        $notice->whole=$req->whole;
        $notice->save();
        $idd= $notice->course->id;
        return redirect()->route('teacher.coursenotice', ['id' => $notice->course->id]);
        //return view('teacher.course')->with('id',3);
        
    }
    public function coursenoteadd(Request $req){
        return view('teacher.coursenoteadd')->with('id',$req->id);
        
    }
    public function noteaddcheck(Request $req){
        $req->validate(
            [
                'name'=>'required'
            ],
            [
                'name.required'=>'You must put your note name'
            ]
        );
        $folder="notes";
        $f_name=$req->name.".".$req->file('note')->getClientOriginalExtension();
        $directory=$req->file('note')->storeAs($folder,$f_name);
        $note= new Note();
        $note->name =$req->name;
        $note->directory =$directory;
        $note->c_id=$req->id;
        $note->save();
        return redirect()->route('teacher.coursenote', ['id' => $req->id]);
        //return view('teacher.login');
    }
    public function coursenotedown(Request $req)
    {
        $note=Note::where('id','=',$req->id)->first();
    return Storage::download($note->directory);
    }
    public function coursenotedel(Request $req)
    {
        $note=Note::where('id','=',$req->id)->first();
    //return Storage::download($note->directory);
    Storage::delete($note->directory);
    Note::where('id', $req->id)->delete();
    return redirect()->route('teacher.coursenote', ['id' => $req->cid]);
    }
    public function logout(){
        session()->flush();
        return redirect()->route('teacher.login');
    }
}
