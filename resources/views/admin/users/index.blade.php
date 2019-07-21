@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Users</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <div class="card-header clearfix">
                        <div class="pull-left">
                            <a href="{{route('users.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> Add
                                New</a>
                        </div>
                        <div class="pull-right">

                        </div>
                    </div>

                    @include('admin.partials.message')

                    @if(! $users->count())
                        <div class="alert alert-danger">
                            <strong>No Record Found</strong>
                        </div>
                    @else
                        @include('admin.users.table')
                    @endif
                </div>
                <div class="box-footer clearfix">
                    <div class="row">
                        <div class="col-md-10">
                            {{$users->appends( Request::query() )->render()}}
                        </div>
                        <div class="col-md-2">
                            <small>{{$userCount}}{{str_plural('item',$userCount)}}</small>
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
