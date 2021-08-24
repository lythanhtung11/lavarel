<div class="alert alert-{{$type}}">
    <ul>
        @foreach($msg->all() as $item)
            <li>{{$item}}</li>
        @endforeach
    </ul>
</div>
