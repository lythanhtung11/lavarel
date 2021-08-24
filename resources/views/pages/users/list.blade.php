@extends('layouts.app1')
@section('content')
<ol>
    @foreach($users as $item)
        <li>{{$item->name}}</li>
    @endforeach
</ol>
@endsection
