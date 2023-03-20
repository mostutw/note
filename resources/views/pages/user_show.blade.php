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

        .show-permission {
            margin: 5px 0;
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
                    @can('isAdmin')
                        <i class="fa fa-pen">&ensp;<a href="{{ url('pages/users/' . $user->id) . '/edit' }}">Edit</a></i>
                    @endcan
                </div><!-- /.box-header -->
                <div class="box-body">
                    <p class="h5 show-title">{{ trans('user.name') }}</p>
                    <p class="h5 show-content">{{ $user->name }}</p>
                    <p class="h5 show-title">{{ trans('user.email') }}</p>
                    <p class="h5 show-content">{{ $user->email }}</p>
                    <p class="h5 show-title">{{ trans('user.status') }}</p>
                    <p class="h5 show-content">{{ $user->is_active ? trans('user.is_active') : trans('user.is_disabled') }}
                    </p>
                    <p class="h5 show-title">{{ trans('user.permission') }}</p>
                    <p class="h5 show-content">
                        @if ($user->role == 'admin')
                            <span class="badge badge-secondary show-permission">{{ trans('user.all') }}</span>
                        @else
                            @forelse($permission_list as $value)
                                <span class="badge badge-secondary show-permission">{{ $value }}</span>
                            @empty
                                <span class="badge badge-secondary show-permission">{{ trans('user.na') }}</span>
                            @endforelse
                        @endif
                    </p>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

    <!-- /.content -->
@endsection

@section('js')
@endsection
