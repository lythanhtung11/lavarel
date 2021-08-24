@extends('layouts.app1')
@section('content')
    <h1>ADD USER</h1>
    @if (count($errors) > 0)
        <x-alert type="danger" :msg="$errors"></x-alert>
    @endif
    <form class="user" action="{{ route('users.store')}}" method="POST">
        @csrf
        @method('POST')
        <div class="form-group" >
            <input type="text" name="name" class="form-control form-control-user" id="name" placeholder="Username">
        </div>
        <div class="form-group">
            <input type="text" name="email" class="form-control form-control-user" id="email" placeholder="Email" >
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Password" >
        </div>
        <div class="form-group">
            <label for="roles">Role:</label>
            <select name="role" id="roles">
                <option value="2">Editor</option>
                <option value="3">Viewer</option>
            </select>
        </div>
        <a class="btn btn-danger" href="/users">Back</a>
        <input type="submit" class="btn btn-primary" value="Create">
    </form>

@endsection
