@extends('layouts.master')

@section('content')
    {!! Form::model($user,[
            'method'=>'DELETE',
            'route'=>['users.destroy',$user->id]
    ]) !!}
    <div class="row">
        <div class="col-xs-9">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">User delete confirmation</h3>
                </div>
                <div class="card-body">
                    <p>You have specified this user for deletion:</p>
                    <p>ID #{{$user->id}}:{{$user->name}}</p>
                    <p>What shold be done with user content</p>
                    <p>
                        <input type="radio" name="delete_option" value="delete" checked> Delete All Content
                    </p>
                    <p>
                        <input type="radio" name="delete_option" value="attribute"> Attribute content to:
                        {!! Form::select('selected_user',$users,null) !!}
                    </p>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-danger">Confirm Deletion</button>
                    <a href="{{route('users.index')}}" class="btn btn-default">Cancel</a>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
