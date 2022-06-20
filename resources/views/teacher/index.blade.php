@extends('layouts.teacher')
@section('content')


<h4>Hello, {{$t->designation}} <a href="{{route('teacher.profile')}}" >{{$t->name}}</a> </h4>
<br/><br/>
@php
$f = 1;
$day=strtolower(date('l'));
@endphp
@foreach($t->courses as $c)
@if(json_decode($c->course->schedule)[0]->day==$day)
<a  class="btn btn-secondary" href="{{route('teacher.course', ['id' => $c->course->id])}}">course name: {{$c->course->name}}  </a>

<h5>Type: {{json_decode($c->course->schedule)[0]->type}} | Day: {{json_decode($c->course->schedule)[0]->day}}</h5>
<h5>Building: {{json_decode($c->course->schedule)[0]->building}}
| Floor: {{json_decode($c->course->schedule)[0]->floor}}
| Room no: {{json_decode($c->course->schedule)[0]->room}}
| Time: {{json_decode($c->course->schedule)[0]->time}}</h5><hr/>
@php
$f=2
@endphp
@endif
@if(json_decode($c->course->schedule)[1]->day==$day)
<a  class="btn btn-secondary" href="{{route('teacher.course', ['id' => $c->course->id])}}">course name: {{$c->course->name}} </a>
    
    <h5>Type: {{json_decode($c->course->schedule)[1]->type}} | Day: {{json_decode($c->course->schedule)[1]->day}}</h5>
<h5>Building: {{json_decode($c->course->schedule)[1]->building}}
| Floor: {{json_decode($c->course->schedule)[1]->floor}}
| Room no: {{json_decode($c->course->schedule)[1]->room}}
| Time: {{json_decode($c->course->schedule)[1]->time}}</h5><hr/>
@php
$f=2
@endphp
@endif

@endforeach
@if($f==1)
<p>No class</p>
@endif
@endsection