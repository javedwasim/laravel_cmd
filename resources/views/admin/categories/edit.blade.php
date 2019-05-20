@extends('layouts.master')

@section('content')
    {!! Form::model($category,['method'=>'PUT','route'=>['categories.update',$category->id],'files'=>True,'id'=>'category-form']) !!}
    <div class="row">
        @include('admin.categories.form')
    </div>
    {!! Form::close() !!}
@endsection

@include('admin.categories.script')
