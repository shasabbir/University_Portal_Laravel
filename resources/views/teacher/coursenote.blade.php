@extends('layouts.teacher')
@section('content')
<a class="btn btn-danger" href="{{route('teacher.coursenoteadd', ['id' => $cid])}}">Add note </a>

@php
$f = 1;
@endphp
<table>
  <tr>
    <th>name</th>
    <th></th>
    <th></th>
  </tr>
  @foreach($notes as $note)
  <tr>
    <td>{{$note->name}}</td>
    <td><a class="btn btn-danger" href="{{route('teacher.coursenotedown', ['id' => $note->id])}}">Download </a></td>
    <td><a class="btn btn-danger" href="{{route('teacher.coursenotedel', ['id' => $note->id,'cid'=>$cid])}}">Delete </a></td>
  </tr>
  @php
$f = 2;
@endphp
  @endforeach
</table>
@if($f==1)
<p>No note posted</p>
@endif
@endsection