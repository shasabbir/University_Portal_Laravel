@extends('layouts.teacher')
@section('content')

    <form action="{{route('teacher.logincheck')}}" method="post">
        {{@csrf_field()}}
        <input type="text" value="{{old('id')}}" name="id" placeholder="Insert Id"><br>
        @error('id')
        <p>{{$message}}</p>
        @enderror
        <input type="password" name="password" placeholder="Password"><br>
        @error('password')
        <p>{{$message}}</p>
        @enderror
        <input type="submit" value="Login">

    </form>
    {{ Session::get('message') }}

@endsection