@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Post</h3>

                </div>
                <!-- /.card-body -->
                <div class="card-body table-responsive p-0">
                    {!! Form::model($post,[
                        'method'=>'POST',
                        'route'=>'posts.store',
                        'files'=>True,
                    ]) !!}

                    <div class="form-group {{$errors->has('title')?'has-error':''}}">
                        {!! Form::label('title') !!}
                        {!! Form::text('title',null,['class'=>'form-control']) !!}

                        @if($errors->has('title'))
                            <span class="help-block" style="color: red">{{$errors->first('title')}}</span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has('slug')?'has-error':''}}">
                        {!! Form::label('slug') !!}
                        {!! Form::text('slug',null,['class'=>'form-control']) !!}

                        @if($errors->has('slug'))
                            <span class="help-block" style="color: red">{{$errors->first('slug')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('excerpt') !!}
                        {!! Form::text('excerpt',null,['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group {{$errors->has('body')?'has-error':''}}">
                        {!! Form::label('body') !!}
                        {!! Form::textarea('body',null,['class'=>'form-control']) !!}

                        @if($errors->has('body'))
                            <span class="help-block" style="color: red">{{$errors->first('body')}}</span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has('published_at')?'has-error':''}}">
                        {!! Form::label('published_at','Publish Date') !!}
                        {!! Form::text('published_at',null,['class'=>'form-control','Placeholder'=>'Y-m-d H:i:s']) !!}

                        @if($errors->has('published_at'))
                            <span class="help-block" style="color: red">{{$errors->first('published_at')}}</span>
                        @endif
                    </div>

                    <div class="form-group {{$errors->has('image')?'has-error':''}}">
                        {!! Form::label('image','Feature Image') !!}
                        {!! Form::file('image') !!}

                        @if($errors->has('image'))
                            <span class="help-block" style="color: red">{{$errors->first('image')}}</span>
                        @endif
                    </div>

                    <div class="form-group {{$errors->has('category_id')?'has-error':''}}">
                        {!! Form::label('category_id','Category') !!}
                        {!! Form::select('category_id',App\Category::pluck('title','id'),null,['class'=>'form-control','placeholder'=>'Choose Category']) !!}

                        @if($errors->has('category_id'))
                            <span class="help-block" style="color: red">{{$errors->first('category_id')}}</span>
                        @endif
                    </div>

                    <hr>
                    {!! Form::submit('Create new post',['class'=>'btn btn-primary']) !!}
                    <hr>

                    {!! Form::close() !!}
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $('ul.pagination').addClass('no-margin pagination-sm');
    </script>
@endsection
