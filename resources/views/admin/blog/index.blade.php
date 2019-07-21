@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Blog Posts</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <div class="card-header clearfix">
                        <div class="pull-left">
                            <a href="{{route('posts.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> Add New</a>
                        </div>
                        <div class="pull-right">
                            <?php $links = []; ?>
                            @foreach($statusList as $key=>$value)
                                @if($value)
                                    <?php $selected = Request::get('status') == $key ? 'selected-status':''; ?>
                                    <?php $links[] = "<a class=\"{$selected}\" href=\"?status={$key}\">" . ucwords($key) . "({$value})</a>" ?>
                                @endif
                            @endforeach
                            {!! implode(' | ',$links) !!}
                        </div>
                    </div>

                   @include('admin.blog.message')

                    @if(! $posts->count())
                        <div class="alert alert-danger">
                            <strong>No Record Found</strong>
                        </div>
                    @elseif($onlyTrashed)
                        @include('admin.blog.table-trash')
                    @else
                        @include('admin.blog.table-all')
                    @endif
                </div>
                <div class="box-footer clearfix">
                    <div class="row">
                        <div class="col-md-10">
                            {{$posts->appends( Request::query() )->render()}}
                        </div>
                        <div class="col-md-2">
                            <small>{{$postCount}}{{str_plural('item',$postCount)}}</small>
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
