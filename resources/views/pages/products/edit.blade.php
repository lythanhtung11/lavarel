@extends('layouts.app1')
@section('content')
    <h1>EDIT</h1>
    <!-- lấy thông tin thông báo đã thêm vào session để hiển thị -->
    @if (count($errors) > 0)
        <x-alert type="danger" :msg="$errors"></x-alert>
    @endif
    {{--    <x-alert type="danger" msg="xin chao cac ban"></x-alert>--}}
    <form class="user" action="{{ route('products.update',['product' => $product->id]) }}" method="POST" enctype="multipart/form-data" >
        @csrf
        @method('PUT')
        <div class="form-group" >
            <input type="text" name="name" class="form-control form-control-user" id="full_name" placeholder="Name" value="{{$product->name}}">
        </div>
        <div class="form-group">
            <input type="text" name="price" class="form-control form-control-user" id="price" placeholder="Price" value="{{$product->price}}">
        </div>
        <div class="form-group">
            <input type="text" name="type" class="form-control form-control-user" id="type" placeholder="Type" value="{{$product->type}}">
        </div>
        <div class="custom-file">
            <input type="file" class="custom-file-input " id="avatar" name="avatar" >
            <label for="avatar" class="custom-file-label">{{$product->avatar}}</label>
        </div>
        <br><br>
        <div class="form-group">
            <img src="{{$product->avatar}}" width="200px">
        </div>

        <a class="btn btn-danger" href="{{ route('products.show',['product'=>$product->id])}}">Back</a>
        <input type="submit" class="btn btn-primary" value="Update">
    </form>
@endsection
@section('js')
    <script>
        $('#avatar').on('change',function(){
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
    </script>
@endsection('js')
