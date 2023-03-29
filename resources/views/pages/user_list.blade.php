@extends('adminlte::page')

@section('css')
    <style>
        .list-box {
            padding: 0 20px 18px;
        }
        thead tr th {
            white-space: nowrap;
        }
    </style>
@endsection

@section('content_header')
    <h1>
        {{-- User List --}}
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i>&nbsp{{ trans('info.home') }}</a></li>
        {{-- <li><a href="#">Pages</a></li> --}}
        <li class="active">User List</li>
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
                            <div class="input-group">
                                <input type="text" name="table_search" class="form-control input-sm pull-right"
                                    style="width: 150px;" placeholder="Search..." />
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                {{-- <th scope="col" class="text-center">{{ trans('user.id') }}</th> --}}
                                <th scope="col">{{ trans('user.name') }}</th>
                                <th scope="col">{{ trans('user.email') }}</th>
                                <th scope="col">{{ trans('user.role') }}</th>
                                <th scope="col">{{ trans('user.status') }}</th>
                                <th scope="col">{{ trans('user.created_at') }}</th>
                                <th scope="col">{{ trans('user.updated_at') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($list as $key => $value)
                                <tr>
                                    <th scope="row" class="text-center">{{ $key + 1 }}</th>
                                    {{-- <td class="text-center">{{ $value->id }}</td> --}}
                                    <td>{{ $value->name }}</td>
                                    <td><a href="{{ url('pages/users/' . $value->id) . '/edit' }}">{{ $value->email }}</a>
                                    </td>
                                    <td>{{ $value->role }}</td>
                                    <td>{{ $value->is_active ? trans('user.is_active') : trans('user.is_disabled') }}</td>
                                    <td>{{ $value->created_at->format('m-d-Y') }}</td>
                                    <td>{{ $value->updated_at->diffForHumans() }}</td>
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
