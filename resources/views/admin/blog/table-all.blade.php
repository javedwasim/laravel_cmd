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
                {!! Form::open(['method'=>'Delete','route'=>['posts.destroy',$post->id]]) !!}
                    @if(check_user_permissions($request,"Blog@edit",$post->id))
                        <a href="{{route('posts.edit',$post->id)}}" class="btn btn-xs btn-default">
                            <i class="fa fa-edit"></i>
                        </a>
                    @else
                        <a href="javascript:void(0)" class="btn btn-xs btn-default disabled">
                            <i class="fa fa-edit"></i>
                        </a>
                    @endif
                    @if(check_user_permissions($request,"Blog@destroy",$post->id))
                        <button type="submit" class="btn btn-xs btn-danger">
                            <i class="fa fa-trash"></i>
                        </button>
                    @else
                        <button type="button" class="btn btn-xs btn-danger disabled">
                            <i class="fa fa-trash"></i>
                        </button>
                    @endif
                {!! Form::close() !!}
            </td>
            <td>{{$post->title}}</td>
            <td>{{$post->author->name}}</td>
            <td>{{$post->category->title}}</td>
            <td>
                <abbr title="{{$post->dateFormatted(true)}}">{{$post->dateFormatted()}}</abbr>
                {!! $post->publicationLabel() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>