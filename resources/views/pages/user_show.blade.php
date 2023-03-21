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
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h4 class="box-title"><i class="fa fa-user">&nbsp{{ trans('user.user_profile') }}</i></h4>
                    @can('isAdmin')
                        <h4 class="box-title"><i class="fa fa-pen">&nbsp<a
                                    href="{{ url('pages/users/' . $user->id) . '/edit' }}">{{ trans('user.edit') }}</a></i></h4>
                    @endcan
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label">{{ trans('user.name') }}</label>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <span>{{ $user->name }}</span>
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
                                <span>{{ $user->email }}</span>
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
                            <div class="form-group">
                                <span>{{ $user->is_active ? trans('user.is_active') : trans('user.is_disabled') }}</span>
                            </div>
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
                </div><!-- /.box-body -->
                 <div class="box-footer">
                        <div class="col-md-12">
                            <div class="col-md-2">
                                {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                            </div>
                        </div>
                    </div>
            </div><!-- /.box -->
        </div>
    </div>
    <!-- /.content -->
@endsection

@section('js')
@endsection
