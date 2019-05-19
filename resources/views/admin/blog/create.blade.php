@extends('layouts.master')

@section('content')
    {!! Form::model($post,['method'=>'POST','route'=>'posts.store','files'=>True,'id'=>'post-form']) !!}
    <div class="row">
        @include('admin.blog.form')
    </div>
    {!! Form::close() !!}
@endsection

@include('admin.blog.script')
