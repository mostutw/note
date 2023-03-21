@extends('adminlte::page')

@section('css')

@section('content_header')
    <!-- Content Header (Page header) -->
    <h1>
        Test
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
        {{-- <li><a href="#">Pages</a></li> --}}
        <li class="active">Test</li>
    </ol>
@endsection

@section('content')
    <!-- Main content -->
    <div class="row">
        {{-- 自訂 --}}
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h4 class="box-title"><i class="fa fa-info">Test Page</i></h4>
                </div><!-- /.box-header -->
                <div class="box-body">
                    {{-- col-md-12 可將區塊切割為12等分 --}}
                    <div class="col-md-12">
                        {{-- 佔6分 --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Title</label>
                            </div>
                        </div>
                        {{-- 佔6分 --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Content</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>名稱:</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>測試員</label>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
    <!-- /.content -->
@endsection

@section('js')
@endsection
