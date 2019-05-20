@extends('layouts.master')

@section('content')
    {!! Form::model($category,['method'=>'POST','route'=>'categories.store','files'=>True,'id'=>'category-form']) !!}
    <div class="row">
        @include('admin.categories.form')
    </div>
    {!! Form::close() !!}
@endsection

@include('admin.blog.script')
