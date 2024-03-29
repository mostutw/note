@extends('adminlte::page')

@section('css')
<style>
    .box-title {
        padding: 10px 30px;
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
        <li><a href="/"><i class="fa fa-dashboard"></i>&nbsp{{ trans('info.home') }}</a></li>
        {{-- <li><a href="#">Pages</a></li> --}}
        <li class="active">User Create</li>
    </ol>
@endsection

@section('content')
    <!-- Main content -->
    <div class="row">
        {{-- 自訂 --}}
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-plus"></i>&nbsp{{ trans('user.create_user') }}</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ url('pages/users') }}" method="post">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <!-- textarea -->
                                <div class="form-group">
                                    <label>{{ trans('user.name') }}</label>
                                    <input type="text" class="form-control" name="name" placeholder=""
                                        value="{{ old('name') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <!-- textarea -->
                                <div class="form-group">
                                    <label>{{ trans('user.email') }}</label>
                                    <input type="email" class="form-control" name="email" placeholder=""
                                        value="{{ old('email') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>{{ trans('user.password') }}</label>
                                    <input type="password" class="form-control" name="password" placeholder=""
                                        value="{{ old('password') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>&emsp;</label>
                                    <input type="password" class="form-control" name="confirm_passowrd" placeholder=""
                                        value="{{ old('confirm_passowrd') }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
    </div>

    <!-- /.content -->
@endsection

@section('js')
    <!-- tinymce -->
    <script src='https://cdn.tiny.cloud/1/hn3o0tmszhnrb0adtmub1316kgfdva1wwx1dcwivusv5n56a/tinymce/4/tinymce.min.js'>
    </script>
    <script>
        tinymce.init({
            selector: '#mytextarea'
        });
    </script>
@endsection
