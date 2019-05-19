<table class="table table-hover">
    <tbody>
    <tr>
        <th width="125">Action</th>
        <th width="300">Title</th>
        <th>Author</th>
        <th>Category</th>
        <th>Date</th>
    </tr>
    @foreach($posts as $post)
        <tr>
            <td>
                {!! Form::open(['method'=>'Delete','route'=>['posts.destroy',$post->id]]) !!}
                <a href="{{route('posts.edit',$post->id)}}" class="btn btn-xs btn-default">
                    <i class="fa fa-edit"></i>
                </a>
                <button type="submit" class="btn btn-xs btn-danger">
                    <i class="fa fa-trash"></i>
                </button>
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