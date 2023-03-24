@extends('adminlte::page')

@section('title', 'AdminLTE')

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
    <h1>{{ trans('home.dashboard') }}</h1>
@stop

@section('content')
<div class="row">
    {{-- 自訂 --}}
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h4 class="box-title"><i class="fa fa-user">&nbsp{{ trans('user.user_profile') }}</i></h4>
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
        </div><!-- /.box -->
    </div>
</div>

@stop
