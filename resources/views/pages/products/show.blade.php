@extends('layouts.app1')
@section('content')
    <h2>Name : {{$product->name}}</h2>
    <p>Price : {{$product->price}}$</p>
    <p>Type : {{$product->type}}</p>
    <img src="{{$product->avatar}}" style="display: block;" width="200px">
    <a href="/products" class="btn btn-danger">Back</a>
    <a class="btn btn-success" href="{{route('products.edit',$product->id)}}">Edit</a>
@endsection
