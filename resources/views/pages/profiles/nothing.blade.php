@extends('layouts.app1')
@section('content')

    <h1 class="alert alert-danger">{{$user->name}} chưa có profile</h1>
    <a class="btn btn-danger" href="{{ route('users.index')}}">Back</a>
    <a href="{{ route('profiles.create', ['user_id'=>$user_id])}}" class="btn btn-primary">Tạo profile</a>
@endsection
