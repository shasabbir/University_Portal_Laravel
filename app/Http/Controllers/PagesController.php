<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class PagesController extends Controller
{
    //
    public function index(){
        return view('home.index');
    }public function login(){
        return view('home.login');
    }public function reg(){
        return view('home.reg');
    }public function loginsubmit(Request $r){
        $r->validate([
            'name'=>'required',
            'password'=>'required|min:4|max:8'
        ],
        [
            'password.max'=>'to big',
            'password.min'=>'to small',
        ]
    );
        return 'name: '.$r->name.'  pass: '.$r->password;
        return view('home.login');
    }public function regsubmit(Request $r){
        $this->validate($r,[
            'name'=>'required',
            'cgpa'=>'required',
            'id'=>'required',
            'password'=>'required|min:4|max:8'
        ],
        [
            'password.max'=>'to big',
            'password.min'=>'to small',
        ]
    );
    $st =new Student();
    $st->name=$r->name;
    $st->id=$r->id;
    $st->cgpa=$r->cgpa;
    $st->password=$r->password;
    $st->save();
        return 'name: '.$r->name.'  pass: '.$r->password;
        return view('home.login');
    }
}
