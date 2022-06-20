@extends('layouts.teacher')
@section('content')
<html>
    <form action="{{route('teacher.noticeeditc', ['id' => $notice->id])}}" method="post">
        {{@csrf_field()}}
        <input type="text" value="{{$notice->headline}}" name="headline" placeholder="Headline"><br>
        
        <input type="text" value="{{$notice->whole}}" name="whole" placeholder="Whole"><br>
        
        <input type="hidden" value="{{$notice->id}}" name="id" >
        
        
        <input type="submit" value="Edit">

    </form>
</html>
@endsection