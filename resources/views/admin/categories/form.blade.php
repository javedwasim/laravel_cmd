<div class="col-md-9">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create Category</h3>
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

        </div>
        <!-- /.card-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">{{$category->exists ? 'Update':'Save'}}</button>
            <a href="{{route('categories.index')}}" class="btn btn-default">Cancel</a>
        </div>
    </div>
    <!-- /.card -->
</div>