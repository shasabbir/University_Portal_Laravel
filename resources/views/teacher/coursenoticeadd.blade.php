@extends('layouts.teacher')
@section('content')
<html>
    <form action="{{route('teacher.noticeaddcheck')}}" method="post">
        {{@csrf_field()}}
        <input type="text" value="{{old('headline')}}" name="headline" placeholder="Headline"><br>
        @error('headline')
        <p>{{$message}}</p>
        @enderror
        <input type="text" value="{{old('whole')}}" name="whole" placeholder="Whole"><br>
        @error('whole')
        <p>{{$message}}</p>
        @enderror 
        <input type="hidden" value="{{$id}}" name="id" >
        
        
        <input type="submit" value="Post">

    </form>
</html>
@endsection