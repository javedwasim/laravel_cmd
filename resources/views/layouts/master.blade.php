<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>My | Blog</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{$app->make('url')->to('/').'/public/css/app.css'}}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">
    <!-- Navbar -->
    @include('layouts.admin_nav')
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    @include('layouts.admin_sidebar')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('layouts.admin_content_header')
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <router-view></router-view>
                <vue-progress-bar></vue-progress-bar>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2014-2018 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="{{$app->make('url')->to('/').'/public/js/app.js'}}"></script>
</body>
</html>
