@extends('adminlte::page')

@section('css')
    <style>
        .list-box {
            padding: 0 20px 18px;
        }
    </style>
@endsection

@section('content_header')
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <h1>
        {{-- Flow List --}}
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        {{-- <li><a href="#">Pages</a></li> --}}
        <li class="active">Flow List</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box list-box">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                    <div class="box-tools">
                        <form role="form">
                            <div class="form-group">
                                <div class="form-group col-xs-12 col-md-2 pull-left">
                                    <input type="text" name="q_id" class="form-control input-sm pull-left"
                                        value="{{ $filters['q_id'] }}" placeholder="{{ trans('flow.id') }}" />
                                </div>
                                <div class="form-group col-xs-12 col-md-2">
                                    <input type="text" name="q_title" class="form-control input-sm pull-left"
                                        value="{{ $filters['q_title'] }}" placeholder="{{ trans('flow.title_name') }}" />
                                </div>
                                <div class="form-group col-xs-12 col-md-2">
                                    <input type="text" name="q_name" class="form-control input-sm pull-left"
                                        value="{{ $filters['q_name'] }}" placeholder="{{ trans('flow.apply_name') }}" />
                                </div>
                                <div class="form-group col-xs-12 col-md-2">
                                    <input type="text" name="q_stepuser" class="form-control input-sm pull-left"
                                        value="{{ $filters['q_stepuser'] }}"
                                        placeholder="{{ trans('flow.flow_sign_name') }}" />
                                </div>
                                <div class="form-group col-xs-12 col-md-2">
                                    <select class="form-control input-sm pull-left" name="q_status" id="q_status"
                                        value="{{ $filters['q_status'] }}">
                                        @foreach ($menu as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ $filters['q_status'] == $key ? 'selected' : '' }}>{{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xs-12 col-md-2">
                                    <button class="btn btn-sm btn-default pull-left"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ trans('flow.id') }}</th>
                                <th scope="col">{{ trans('flow.apply_name') }}</th>
                                <th scope="col">{{ trans('flow.title_name') }}</th>
                                <th scope="col">{{ trans('flow.status') }}</th>
                                
                                <th scope="col">{{ trans('flow.flow_sign_name') }}</th>
                                <th scope="col">{{ trans('flow.flow_stepname') }}</th>
                                <th scope="col">{{ trans('flow.create_date') }}</th>
                                <th scope="col">{{ trans('flow.update_date') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($list as $key => $value)
                                <tr>
                                    <th class="row">{{ $key + 1 }}</th>
                                    <td>{{ $value['id'] }}</td>
                                    <td>{{ $value['name'] }}</td>
                                    <td>{{ $value['title_name'] }}</td>
                                    <td>{{ $value['status_name'] }}</td>
                                    
                                    <td>{{ $value['flow_sign_name'] }}</td>
                                    <td>{{ $value['flow_stepname'] }}</td>
                                    <td>{{ $value['create_date_format'] }}</td>
                                    <td>{{ $value['update_date_format'] }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="10">No Data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- {{ $list->appends($filters)->links() }} --}}
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        {{ $list->appends($filters)->links() }}
                    </ul>
                </div>
            </div><!-- /.box -->
        </div>
    </div>
@endsection
