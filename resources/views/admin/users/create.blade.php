@extends('layouts.master')

@section('content')
    {!! Form::model($user,['method'=>'POST','route'=>'users.store','files'=>True,'id'=>'user-form']) !!}
    <div class="row">
        @include('admin.users.form')
    </div>
    {!! Form::close() !!}
@endsection
