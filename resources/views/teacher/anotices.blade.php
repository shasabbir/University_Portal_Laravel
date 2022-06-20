@extends('layouts.teacher')
@section('content')
<h1>Admin Notices</h1>


@php
$f = 1;
@endphp
<table>
  <tr>
    <th>Headline</th>
    <th>Whole</th>
  </tr>
  @foreach($anotices as $notice)
  <tr>
    <td>{{$notice->headline}}</td>
    <td>{{$notice->whole}}</td>
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