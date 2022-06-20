@extends('layouts.teacher')
@section('content')
<html>
    <form action="{{route('teacher.noteaddcheck')}}" method="post" enctype="multipart/form-data">
        {{@csrf_field()}}
        <input type="text" value="" name="name" placeholder="Name"><br>
        @error('name')
        <p>{{$message}}</p>
        @enderror
        <input type="file" name="note" >
        <input type="hidden" value="{{$id}}" name="id" >
        
        
        <input type="submit" value="Post">

    </form>
</html>
@endsection