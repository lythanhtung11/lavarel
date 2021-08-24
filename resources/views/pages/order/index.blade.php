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
<h2>Danh sách hóa đơn</h2>

<table style="border: 2px solid black ;border-spacing: 25px">
    <tr style="color:red">
        <th>Mã Hóa Đơn</th>
        <th style="text-align: right;">Function</th>
    </tr>
    @foreach($orders as $order)
        <tr>
            <td style="text-align: center;">  {{$order->id}}</td>
            <td><a class="btn btn-primary" href="orders/{{$order->id}}">Chi tiết</a></td>
            <form action="{{route('orders.destroy',['order' => $order->id])}}" method="POST">
                @csrf
                @method('DELETE')
                <td><input onclick="return alert()" type="submit" value="Xóa" class="btn btn-danger"></td>
            </form>
        </tr>
    @endforeach
</table>
@endsection

