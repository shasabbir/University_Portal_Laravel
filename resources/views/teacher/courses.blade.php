@extends('layouts.teacher')
@section('content')
<h1>All Courses</h1>





@foreach($t->courses as $c)

<a  class="btn btn-secondary" href="{{route('teacher.course', ['id' => $c->course->id])}}">course name: {{$c->course->name}} </a>

    <h6>Type: {{json_decode($c->course->schedule)[0]->type}} | Day: {{json_decode($c->course->schedule)[0]->day}}</h6>
<h6>Building: {{json_decode($c->course->schedule)[0]->building}}
| Floor: {{json_decode($c->course->schedule)[0]->floor}}
| Room no: {{json_decode($c->course->schedule)[0]->room}}
| Time: {{json_decode($c->course->schedule)[0]->time}}</h6>
<br/>
<h6>Type: {{json_decode($c->course->schedule)[1]->type}} | Day: {{json_decode($c->course->schedule)[1]->day}}</h6>
<h6>Building: {{json_decode($c->course->schedule)[1]->building}}
| Floor: {{json_decode($c->course->schedule)[1]->floor}}
| Room no: {{json_decode($c->course->schedule)[1]->room}}
| Time: {{json_decode($c->course->schedule)[1]->time}}</h6><br/><hr/>
@php
$f=2
@endphp


@endforeach
@if($f==1)
<p>No courses</p>
@endif
@endsection