@extends('layouts.app1')
@section('content')
    <script>
        function alert() {
            let result = confirm("Want to delete?");
            if (result) {
                return true;
            }
            return false;
        }
    </script>
    <head>
        <style>
            .card{
                width:250px;
                border-radius:5px;
                padding:10px;
                box-shadow:0 4px 8px 0 rgba(0,0,0,0.2);
                transition:0.3s;
            }

            .card:hover {
                box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            }

            #margin-card{
                text-align:center;
                margin-top:20px;
            }
        </style>
    </head>

    <div class="container">
        <a href="{{route('products.create')}}" class="btn btn-primary">Thêm sản phẩm </a>
        <div class="row">
            @foreach($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-3" id="margin-card">
                    <div class="card">
                        {{$product->name}}
                        <img src="{{$product->avatar}}" style="width:200px;margin:10px;" />
                        <p>Price: {{$product->price}}$</p>
                        <a class="btn btn-secondary" href="{{route('products.show',[$product->id])}}">Details</a>
                        <form action="{{route('products.destroy',['product' => $product->id])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <td><input onclick="return alert()" type="submit" value="Remove" class="btn btn-danger"></td>
                        </form>
                    </div>
                </div>
                @endforeach
        </div>
    </div>
@endsection
