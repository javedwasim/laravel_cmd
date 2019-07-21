<table class="table table-hover">
    <tbody>
    <tr>
        <th width="125">Action</th>
        <th width="300">Title</th>
        <th>Author</th>
        <th>Category</th>
        <th>Date</th>
    </tr>
    <?php $request = request(); ?>
    @foreach($posts as $post)
        <tr>
            <td>
                {!! Form::open(['style'=>'display:inline-block;','method'=>'PUT','route'=>['post.restore',$post->id]]) !!}
                @if(check_user_permissions($request,"Blog@restore",$post->id))
                    <button type="submit" class="btn btn-xs btn-default">
                        <i class="fa fa-undo"></i>
                    </button>
                @else
                    <button type="button" class="btn btn-xs btn-default disabled">
                        <i class="fa fa-undo"></i>
                    </button>
                @endif
                {!! Form::close() !!}

                {!! Form::open(['style'=>'display:inline-block;','method'=>'Delete','route'=>['post.force-destroy',$post->id]]) !!}
                @if(check_user_permissions($request,"Blog@forceDestroy",$post->id))
                    <button type="submit" onclick="return confirm('You are about to delete post permanently. Are you sure?')" class="btn btn-xs btn-danger">
                        <i class="fa fa-times"></i>
                    </button>
                @else
                    <button type="button"  class="btn btn-xs btn-danger disabled">
                        <i class="fa fa-times"></i>
                    </button>
                @endif
                {!! Form::close() !!}
            </td>
            <td>{{$post->title}}</td>
            <td>{{$post->author->name}}</td>
            <td>{{$post->category->title}}</td>
            <td>
                <abbr title="{{$post->dateFormatted(true)}}">{{$post->dateFormatted()}}</abbr>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>