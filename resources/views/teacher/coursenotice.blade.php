@extends('layouts.teacher')
@section('content')
<a class="btn btn-danger" href="{{route('teacher.coursenoticeadd', ['id' => $cid])}}">Add Notice </a>

@php
$f = 1;
@endphp
<table>
  <tr>
    <th>Headline</th>
    <th>Whole</th>
    <th></th>
    <th></th>
  </tr>
  @foreach($notices as $notice)
  <tr>
    <td>{{$notice->headline}}</td>
    <td>{{$notice->whole}}</td>
    <td><a class="btn btn-danger" href="{{route('teacher.coursenoticedel', ['id' => $notice->id,'cid'=>$cid])}}">Delete Notice </a></td>
    <td><a class="btn btn-info" href="{{route('teacher.noticeedit', ['id' => $notice->id])}}">Edit Notice </a></td>
  </tr>
  @php
$f = 2;
@endphp
  @endforeach
</table>
@if($f==1)
<p>No notice posted</p>
@endif
@endsection