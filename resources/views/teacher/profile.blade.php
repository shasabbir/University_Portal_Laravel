
@extends('layouts.teacher')
@section('content')
<h4>Hello, {{$t->designation}} <a href="{{route('teacher.profile', ['id' => $t->id])}}" >{{$t->name}}</a> </h4>
<br/>
<br/>
<h3>Name: {{$t->name}} </h3>
<h3>Date of Birth: {{$t->dob}}</h3>
<h3>Address: {{$t->address}}</h3>
<h3>Designation: {{$t->designation}}</h3>
<h3>Blood Group: {{$t->bg}}</h3>
<h3></h3>

<a class="btn btn-info"  href="{{route('teacher.profileedit')}}">Edit Profile</a>
@endsection