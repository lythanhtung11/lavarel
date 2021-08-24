@extends('layouts.app1')
@section('content')
    <h1>ADD PROFILE</h1>
    @if (count($errors) > 0)
        <x-alert type="danger" :msg="$errors"></x-alert>
    @endif
    <form class="user" action="{{ route('profiles.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-group" >
            <div class="form-group">
                <input type="hidden" value="{{$user_id}}"  name="user_id"  class="form-control form-control-user" id="user_id" >
            </div>
            <input type="text" name="full_name" class="form-control form-control-user" id="full_name" placeholder="Full Name">
        </div>
        <div class="form-group">
            <input type="text" name="phone" class="form-control form-control-user" id="phone" placeholder="Phone" >
        </div>
        <div class="form-group">
            <input type="text" name="address" class="form-control form-control-user" id="address" placeholder="Address" >
        </div>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="date" class="form-control form-control-user" name="birthday" id="birthday" placeholder="Birthday">
            </div>
        </div>
        <div class="custom-file">
            <input type="file" class="custom-file-input " id="avatar" name="avatar" >
            <label for="avatar" class="custom-file-label"></label>
        </div>
        <br><br>
        <a class="btn btn-danger" href="{{ route('users.index')}}">Back</a>
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
