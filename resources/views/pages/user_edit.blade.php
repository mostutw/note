@extends('adminlte::page')

@section('css')
    <style>
        .box-title {
            padding: 10px 30px;
        }

        @media (min-width: 768px) {
            .box-body {
                /* width: 65%; */
            }
        }
    </style>
@endsection

@section('content_header')
    <!-- Content Header (Page header) -->
    <h1>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        {{-- <li><a href="#">Pages</a></li> --}}
        <li class="active">User Edit</li>
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
                <form role="form" action="{{ url('pages/users/' . $user->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">{{ trans('user.name') }}</label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" placeholder=""
                                        value="{{ $user->name }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">{{ trans('user.email') }}</label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder=""
                                        value="{{ $user->email }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">{{ trans('user.password') }}</label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="password" class="form-control" name="new_password" placeholder=""
                                        value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">{{ trans('user.status') }}</label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <input type="radio" name="is_active" value="1"
                                    @if ($user->is_active) checked @endif>
                                {{ trans('user.is_active') }}

                                <input type="radio" name="is_active" value="0"
                                    @if (!$user->is_active) checked @endif>
                                {{ trans('user.is_disabled') }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">{{ trans('user.permission') }}</label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    @if ($user->role == 'admin')
                                        <span class="badge badge-secondary">{{ trans('user.all') }}</span>
                                    @else
                                        @forelse($permission_list as $value)
                                            <span class="badge badge-secondary">{{ $value }}</span>
                                        @empty
                                            <span class="badge badge-secondary">{{ trans('user.na') }}</span>
                                        @endforelse
                                    @endif
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
                            <div class="col-md-2">
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
