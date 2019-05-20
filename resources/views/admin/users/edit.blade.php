@extends('layouts.master')

@section('content')
    {!! Form::model($user,['method'=>'PUT','route'=>['users.update',$user->id],'files'=>True,'id'=>'user-form']) !!}
    <div class="row">
        @include('admin.users.form')
    </div>
    {!! Form::close() !!}
@endsection
