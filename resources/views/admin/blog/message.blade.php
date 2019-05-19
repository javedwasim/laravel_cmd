@if(session('message'))
    <div class="alert alert-success">
        {{session('message')}}
    </div>
@elseif(session('trash-message'))
    <div class="alert alert-info">
        @php list($message,$postid) = session('trash-message') @endphp
        {{$message}}
        @if($postid)
            {!! Form::open(['method'=>'PUT','route'=>['post.restore',$postid]]) !!}
            <button type="submit" class="btn btn-xs btn-warning"><i class="fa fa-undo"></i> Undo</button>
            {!! Form::close() !!}
        @endif
    </div>
@endif



















