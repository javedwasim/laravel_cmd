<div class="col-md-9">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{$user->exists ? 'Update':'Create'}} User</h3>
        </div>
        <!-- /.card-body -->
        <div class="card-body table-responsive p-0">
            <div class="form-group {{$errors->has('name')?'has-error':''}}">
                {!! Form::label('name') !!}
                {!! Form::text('name',null,['class'=>'form-control']) !!}

                @if($errors->has('name'))
                    <span class="help-block" style="color: red">{{$errors->first('name')}}</span>
                @endif
            </div>
            <div class="form-group {{$errors->has('email')?'has-error':''}}">
                {!! Form::label('email') !!}
                {!! Form::text('email',null,['class'=>'form-control']) !!}

                @if($errors->has('email'))
                    <span class="help-block" style="color: red">{{$errors->first('email')}}</span>
                @endif
            </div>
            <div class="form-group {{$errors->has('bio')?'has-error':''}}">
                {!! Form::label('bio') !!}
                {!! Form::textarea('bio',null,['class'=>'form-control']) !!}

                @if($errors->has('bio'))
                    <span class="help-block" style="color: red">{{$errors->first('bio')}}</span>
                @endif
            </div>
            <div class="form-group {{$errors->has('password')?'has-error':''}}">
                {!! Form::label('password') !!}
                {!! Form::password('password',['class'=>'form-control']) !!}

                @if($errors->has('password'))
                    <span class="help-block" style="color: red">{{$errors->first('password')}}</span>
                @endif
            </div>
            <div class="form-group {{$errors->has('password_confirmation')?'has-error':''}}">
                {!! Form::label('password_confirmation') !!}
                {!! Form::password('password_confirmation',['class'=>'form-control']) !!}

                @if($errors->has('password_confirmation'))
                    <span class="help-block" style="color: red">{{$errors->first('password_confirmation')}}</span>
                @endif
            </div>
            <div class="form-group {{$errors->has('role')?'has-error':''}}">
                {!! Form::label('role') !!}
                @if($user->exists && $user->id == config('cms.default_user_id'))
                    {!! Form::hidden('role',$user->roles->first()->id) !!}
                    <p class="form-control-static">{{$user->roles->first()->display_name}}</p>
                @else
                    {!! Form::select('role',App\Role::pluck('display_name','id'),$user->exists ? $user->roles->first()->id:null, ['class'=>'form-control','placeholder'=>'Select a role']) !!}
                @endif
                @if($errors->has('password_confirmation'))
                    <span class="help-block" style="color: red">{{$errors->first('password_confirmation')}}</span>
                @endif
            </div>
        </div>
        <!-- /.card-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">{{$user->exists ? 'Update':'Save'}}</button>
            <a href="{{route('users.index')}}" class="btn btn-default">Cancel</a>
        </div>
    </div>
    <!-- /.card -->
</div>