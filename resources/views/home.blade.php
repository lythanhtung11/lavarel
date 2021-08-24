@extends('layouts.app1')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if( Auth::user()->role_id == 1)
                <a href="/users" class="btn btn-success">Quản lý users</a>
                <a href="/orders" class="btn btn-success">Quản lý Orders</a>
            @elseif(Auth::user()->role_id == 2)
                <a href="/orders" class="btn btn-success">Quản lý Orders</a>
                <a href="/products" class="btn btn-success">Quản lý Products</a>
            @else

            @endif
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
