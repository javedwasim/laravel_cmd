<div class="col-md-9">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create Post</h3>
        </div>
        <!-- /.card-body -->
        <div class="card-body table-responsive p-0">
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
            <div class="form-group excerpt">
                {!! Form::label('excerpt') !!}
                {!! Form::text('excerpt',null,['class'=>'form-control']) !!}
            </div>

            <div class="form-group body {{$errors->has('body')?'has-error':''}}">
                {!! Form::label('body') !!}
                {!! Form::textarea('body',null,['class'=>'form-control']) !!}

                @if($errors->has('body'))
                    <span class="help-block" style="color: red">{{$errors->first('body')}}</span>
                @endif
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<div class="col-md-3">
    <div class="card">
        <div class="card-header with-border">
            <div class="card-title">
                <h3>Publish</h3>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group {{$errors->has('published_at')?'has-error':''}}">
                {!! Form::label('published_at','Publish Date') !!}
                <div class='input-group date' id='datetimepicker1'>
                    {!! Form::text('published_at',null,['class'=>'form-control','Placeholder'=>'Y-m-d H:i:s']) !!}
                    <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                </div>

                @if($errors->has('published_at'))
                    <span class="help-block" style="color: red">{{$errors->first('published_at')}}</span>
                @endif
            </div>
        </div>

        <div class="card-footer clearfix">
            <div class="pull-left">
                <a id="draft-btn" class="btn btn-default">Save Draft</a>
            </div>
            <div class="pull-right">
                {!! Form::submit('Publish',['class'=>'btn btn-primary']) !!}
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header with-border">
            <div class="card-title">
                <h3>Category</h3>
            </div>
        </div>
        <div class="card-body text-center">
            <div class="form-group {{$errors->has('category_id')?'has-error':''}}">
                {!! Form::select('category_id',App\Category::pluck('title','id'),null,['class'=>'form-control','placeholder'=>'Choose Category']) !!}

                @if($errors->has('category_id'))
                    <span class="help-block" style="color: red">{{$errors->first('category_id')}}</span>
                @endif
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header with-border">
            <div class="card-title">
                <h3>Feature Image</h3>
            </div>
        </div>
        <div class="card-body text-center">
            <div class="form-group {{$errors->has('image')?'has-error':''}}">
                {!! Form::file('image') !!}

                @if($errors->has('image'))
                    <span class="help-block" style="color: red">{{$errors->first('image')}}</span>
                @endif
            </div>
        </div>
    </div>
</div>