@extends('layouts.app1')

@section('content')
    <h1>Full Name : {{$profile->full_name}}</h1>
    <p>Phone:{{$profile->phone}}</p>
    <p>Address:{{$profile->address}}</p>
    <p>Birthday : {{$profile->birthday}}</p>
    <label>Avatar:</label>
    <img style="display:block" src="{{$profile->avatar}}" width="200px">
    <br>
    <a class="btn btn-danger" href="{{ route('users.index')}}">Back</a>
    <a class="btn btn-primary" href="{{ route('profiles.edit',$profile->user_id)}}">Edit</a>
@endsection
