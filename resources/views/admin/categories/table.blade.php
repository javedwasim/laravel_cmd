<table class="table table-hover">
    <tbody>
    <tr>
        <th>Action</th>
        <th>Category Name</th>
        <th>Post Count</th>
    </tr>
    @foreach($categories as $category)
        <tr>
            <td>
                {!! Form::open(['method'=>'Delete','route'=>['categories.destroy',$category->id]]) !!}
                <a href="{{route('categories.edit',$category->id)}}" class="btn btn-xs btn-default">
                    <i class="fa fa-edit"></i>
                </a>
                @if($category->id == config('cms.default_category_id'))
                    <button onclick="return false" type="submit" class="btn btn-xs btn-danger disabled">
                        <i class="fa fa-times"></i>
                    </button>
                @else
                    <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-xs btn-danger">
                        <i class="fa fa-times"></i>
                    </button>
                @endif
                {!! Form::close() !!}
            </td>
            <td>{{$category->title}}</td>
            <td>{{$category->posts->count()}}</td>
        </tr>
    @endforeach
    </tbody>
</table>