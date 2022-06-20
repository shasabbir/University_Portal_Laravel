@extends('layouts.teacher')
@section('content')
<h2>course name: {{$course->name}} department: {{$course->department->name}}</h2>
<h5>Day: {{json_decode($course->schedule)[0]->day}}  Time: {{json_decode($course->schedule)[0]->time}}</h5>
<h5>Day: {{json_decode($course->schedule)[1]->day}}  Time: {{json_decode($course->schedule)[1]->time}}</h5>
<a class="btn btn-info" href="{{route('teacher.coursenotice', ['id' => $course->id])}}">Notices </a>
<a class="btn btn-info" href="{{route('teacher.coursenote', ['id' => $course->id])}}">Notes </a>
<h2>Students</h2>
<table id="table">
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>CGPA</th>
    <th>Session</th>
    <th>Department</th>
    <th></th>
  </tr>
  @foreach($course->students as $stu)
  <tr>
    <td>{{$stu->student->id}}</td>
    <td>{{$stu->student->name}}</td>
    <td>{{$stu->student->cgpa}}</td>
    <td>{{$stu->student->session}}</td>
    <td>{{$stu->student->department->name}}</td>
    <td><a class="btn btn-info" href="{{route('teacher.student', ['id' => $stu->student->id])}}">Profile </a></td>
  </tr>
  @endforeach
</table>
@endsection

<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>