@extends('layouts.teacher')
@section('content')
<h2>Student Details</h2>
<table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Date of birth</th>
    <th>CGPA</th>
    <th>Session</th>
    <th>Address</th>
    <th>Blood group</th>
    <th>Department</th>
  </tr>

  <tr>
    <td>{{$student->id}}</td>
    <td>{{$student->name}}</td>
    <td>{{$student->dob}}</td>
    <td>{{$student->cgpa}}</td>
    <td>{{$student->session}}</td>
    <td>{{$student->address}}</td>
    <td>{{$student->bg}}</td>
    <td>{{$student->department->name}}</td>
</tr>

</table>
@endsection