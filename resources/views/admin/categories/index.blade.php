@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Post Category</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right"
                                   placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <div class="card-header clearfix">
                        <div class="pull-left">
                            <a href="{{route('categories.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> Add New</a>
                        </div>
                        <div class="pull-right">

                        </div>
                    </div>

                   @include('admin.partials.message')

                    @if(! $categories->count())
                        <div class="alert alert-danger">
                            <strong>No Record Found</strong>
                        </div>
                    @else
                        @include('admin.categories.table')
                    @endif
                </div>
                <div class="box-footer clearfix">
                    <div class="row">
                        <div class="col-md-10">
                            {{$categories->appends( Request::query() )->render()}}
                        </div>
                        <div class="col-md-2">
                            <small>{{$categoriesCount}}{{str_plural('item',$categoriesCount)}}</small>
                        </div>
                    </div>
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
