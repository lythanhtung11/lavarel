@extends('layouts.app1')
@section('content')
    <h1>ADD PROFILE</h1>
    @if (count($errors) > 0)
        <x-alert type="danger" :msg="$errors"></x-alert>
    @endif
    <form class="user" action="{{ route('products.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-group" >
            <input type="text" name="name" class="form-control form-control-user" id="full_name" placeholder="Name">
        </div>
        <div class="form-group">
            <input type="text" name="price" class="form-control form-control-user" id="phone" placeholder="Price" >
        </div>
        <div class="form-group">
            <input type="text" name="type" class="form-control form-control-user" id="address" placeholder="Type" >
        </div>
        <div class="custom-file">
            <input type="file" class="custom-file-input " id="avatar" name="avatar" >
            <label for="avatar" class="custom-file-label"></label>
        </div>
        <br><br>
        <a class="btn btn-danger" href="{{ route('products.index')}}">Back</a>
        <input type="submit" class="btn btn-primary"  value="Create">
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
