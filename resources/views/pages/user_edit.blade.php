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
        <li class="active">Maintain Edit</li>
    </ol>
@endsection

@section('content')
    <!-- Main content -->
    <div class="row">
        {{-- 自訂 --}}
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ url('pages/users/' . $edit->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="form-group-row">
                                <div class="col-md-4">
                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label>使用者名稱</label>
                                        <p class="h5">{{ $edit->name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>&emsp;</label>
                                        <input type="text" class="form-control" name="name" placeholder="name" value="{{ old('name') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group-row">
                                <div class="col-md-4">
                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label>電子郵件地址</label>
                                        <p class="h5">{{ $edit->email }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label>&emsp;</label>
                                        <input type="text" class="form-control" name="email" placeholder="email" value="{{ old('email') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>密碼</label>
                                        <input type="password" class="form-control" name="new_password" placeholder="需要修改再輸入..." value="{{ old('new_password') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>&emsp;</label>
                                        <input type="password" class="form-control" name="new_confirm_passowrd" placeholder="再次輸入..." value="{{ old('new_confirm_passowrd') }}">
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
