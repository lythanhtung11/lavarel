@extends('layouts.app1')
@section('content')
    <h1>EDIT</h1>
    <!-- lấy thông tin thông báo đã thêm vào session để hiển thị -->
    @if (count($errors) > 0)
        <x-alert type="danger" :msg="$errors"></x-alert>
    @endif
{{--    <x-alert type="danger" msg="xin chao cac ban"></x-alert>--}}
<form class="user" action="{{ route('profiles.update',['profile' => $profile->id]) }}" method="POST" enctype="multipart/form-data" >
@csrf
@method('PUT')
<div class="form-group" >
    <input type="text" name="full_name" class="form-control form-control-user" id="full_name" placeholder="Full Name" value="{{$profile->full_name}}">
</div>
    <div class="form-group">
        <input type="text" name="phone" class="form-control form-control-user" id="phone" placeholder="Phone" value="{{$profile->phone}}">
    </div>
<div class="form-group">
    <input type="text" name="address" class="form-control form-control-user" id="address" placeholder="Address" value="{{$profile->address}}">
</div>
<div class="form-group row">
    <div class="col-sm-6 mb-3 mb-sm-0">
        <input type="date" class="form-control form-control-user" name="birthday" id="birthday" placeholder="Birthday" value="{{$profile->birthday}}">
    </div>
</div>
    <div class="custom-file">
        <input type="file" class="custom-file-input " id="avatar" name="avatar" >
        <label for="avatar" class="custom-file-label">{{$profile->avatar}}</label>
    </div>
    <br><br>
    <div class="form-group">
        <img src="{{$profile->avatar}}" width="200px">
    </div>

    <a class="btn btn-danger" href="{{ route('profiles.show',['profile'=>$profile->user_id])}}">Back</a>
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
