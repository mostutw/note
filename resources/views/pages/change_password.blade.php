@extends('adminlte::page')

@section('css')
@endsection

@section('content_header')
    <!-- Content Header (Page header) -->
    <h1>
        {{-- Maintain Create --}}
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        {{-- <li><a href="#">Pages</a></li> --}}
        <li class="active">Change Password</li>
    </ol>
@endsection

@section('content')
    <!-- Main content -->
    <div class="row">
        {{-- 自訂 --}}
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ url('pages/change-password') }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="box-body">
                        
                        <div class="col-md-12">
                            <div class="form-group-row">
                                <!-- checkbox -->
                                <div class="col-md-12">
                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group-row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>變更密碼</label>
                                        <input type="password" class="form-control" name="new_password" placeholder="輸入密碼" value="{{ old('new_password') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group-row">
                                <div class="col-md-3">
                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label></label>
                                        <input type="password" class="form-control" name="new_confirm_passowrd" placeholder="再次輸入密碼" value="{{ old('new_confirm_passowrd') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group-row">
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (!empty($messages))
                            <div class="alert alert-success">
                                <ul>
                                    <li>{{ $messages }}</li>
                                </ul>
                            </div>
                        @endif
                    </div>
                </form>
                
            </div><!-- /.box -->
        </div>
    </div>
    <!-- /.content -->
@endsection

@section('js')
@endsection
