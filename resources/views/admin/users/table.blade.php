<table class="table table-hover">
    <tbody>
    <tr>
        <th>Action</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
    </tr>
    <?php $currentUser = auth()->user(); ?>
    @foreach($users as $user)
        <tr>
            <td>
                {{--{!! Form::open(['method'=>'Delete','route'=>['users.destroy',$user->id]]) !!}--}}
                <a href="{{route('users.edit',$user->id)}}" class="btn btn-xs btn-default">
                    <i class="fa fa-edit"></i>
                </a>
                @if($user->id == config('cms.default_user_id') || $user->id == $currentUser->id)
                    <button onclick="return false" type="submit" class="btn btn-xs btn-danger disabled">
                        <i class="fa fa-times"></i>
                    </button>
                @else
                    <a href="{{route('admin.users.confirm',$user->id)}}" class="btn btn-xs btn-danger">
                        <i class="fa fa-times"></i>
                    </a>
                @endif
                {{--{!! Form::close() !!}--}}
            </td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->roles->first()->display_name}}</td>
        </tr>
    @endforeach
    </tbody>
</table>