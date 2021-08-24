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
    <a href="/users/create" class="btn btn-secondary">Create New User</a>
    <br><br>
    <table style="border: 2px solid black ;border-spacing: 25px">
        <tr style="color:red">
        <th>Name</th>
        <th style="text-align: center;">Role</th>
        <th style="text-align: right;">Function</th>

        </tr>
        @foreach($users as $user)
            <tr>
            <td>{{$user->name}}</td>
                @if($user->role_id == 1)
                <td style="text-align: center;">Admin</td>
                @elseif($user->role_id == 2)
                <td style="text-align: center;">Editor</td>
                @else
                <td style="text-align: center;">Viewer</td>
                @endif

            <td><a class="btn btn-primary" href="{{ route('profiles.show', $user->id) }}">Details</a></td>
             <form action="{{ route('users.destroy',['user' => $user->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                   <td><input onclick="return alert()" type="submit" value="DELETE" class="btn btn-danger"></td>
             </form>
            </tr>
        @endforeach
    </table>


@endsection
