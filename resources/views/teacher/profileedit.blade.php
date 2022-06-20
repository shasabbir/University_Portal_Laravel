@extends('layouts.teacher')
@section('content')
<html>
    <form action="{{route('teacher.profileeditc')}}" method="post">
        {{@csrf_field()}}
        Name:<input type="text" value="{{$teacher->name}}" name="name" placeholder="Name"><br>
        
        Address: <input type="text" value="{{$teacher->address}}" name="address" placeholder="Address"><br>
        
        
        
        <input type="submit" value="Edit">

    </form>
</html>
@endsection