@extends('layouts.master')

@section('content')
    {!! Form::model($post,['method'=>'PUT','route'=>['posts.update',$post->id],'files'=>True,'id'=>'post-form']) !!}
    <div class="row">
        @include('admin.blog.form')
    </div>
    {!! Form::close() !!}
@endsection

@include('admin.blog.script')
