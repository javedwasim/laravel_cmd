@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Blog Posts</h3>

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
                    <div class="card-header">
                        <div class="pull-left">
                            <a href="{{route('posts.create')}}" class="btn btn-success">Add New</a>
                        </div>
                    </div>
                    @if(! $posts->count())
                        <div class="alert alert-danger">
                            <strong>No Record Found</strong>
                        </div>
                    @else
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th width="125">Action</th>
                                <th width="300">Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Date</th>
                            </tr>
                            @foreach($posts as $post)
                                <tr>
                                    <td style="wi">
                                        <a href="{{route('posts.edit',$post->id)}}" class="btn btn-xs btn-default">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{route('posts.destroy',$post->id)}}" class="btn btn-xs btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                    <td>{{$post->title}}</td>
                                    <td>{{$post->author->name}}</td>
                                    <td>{{$post->category->title}}</td>
                                    <td>
                                        <abbr title="{{$post->dateFormatted(true)}}">{{$post->dateFormatted()}}</abbr>
                                        {!! $post->publicationLabel() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                <div class="box-footer clearfix">
                    <div class="row">
                        <div class="col-md-10">
                            {{$posts->render()}}
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
