@extends('adminlte::page')

@section('css')
    <style>
        .show-title {
            padding: 0 20px 10px;
        }

        .show-sub-title {
            padding: 0 20px 18px;
        }

        .show-content {
            padding: 0 22px 18px;
        }

        @media (min-width: 768px) {
            .box-body {
                width: 65%;
            }
        }
    </style>
@endsection

@section('content_header')
    <!-- Content Header (Page header) -->
    <h1>
        {{-- User Create --}}
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        {{-- <li><a href="#">Pages</a></li> --}}
        <li class="active">User Show</li>
    </ol>
@endsection

@section('content')
    <!-- Main content -->
    <div class="row">
        {{-- 自訂 --}}
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-user"></i>
                    <h4 class="box-title">User Profile</h4>&emsp;
                    @if (Auth::user()->id == 1)
                        <i class="fa fa-pen">&ensp;<a href="{{ url('pages/users/' . $show->id) . '/edit' }}">Edit</a></i>
                    @endif

                </div><!-- /.box-header -->
                <div class="box-body">
                    <p class="h5 show-title">使用者名稱</p>
                    <p class="h5 show-content">{{ $show->name }}</p>
                    <p class="h5 show-title">電子郵件地址</p>
                    <p class="h5 show-content">{{ $show->email }}</p>
                    <p class="h5 show-title">建立時間</p>
                    <p class="h5 show-content">{{ $show->created_at }}</p>
                    <p class="h5 show-title">修改時間</p>
                    <p class="h5 show-content">{{ $show->updated_at }}</p>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

    <!-- /.content -->
@endsection

@section('js')
@endsection
