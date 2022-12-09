@extends('adminlte::page')

@section('css')
    
@endsection

@section('content_header')
    <h1>
        {{-- Maintain List --}}
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Pages</a></li>
        <li class="active">Maintain List</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                    <div class="box-tools">
                        <div class="input-group">
                            <input type="text" name="table_search" class="form-control input-sm pull-right"
                                style="width: 150px;" placeholder="Search" />
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th class="text-nowrap">Id</th>
                            <th class="text-nowrap">Title</th>
                            <th class="text-nowrap">User</th>
                            <th class="text-nowrap">Date</th>
                            <th class="text-nowrap">Status</th>
                            <th class="text-nowrap">Start Date</th>
                            <th class="text-nowrap">End Date</th>
                        </tr>
                        @forelse ($list as $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->title }}</td>
                                <td>{{ $value->user->name }}</td>
                                <td>{{ $value->created_at }}</td>
                                <td>{{ $value->status }}</td>
                                <td>{{ $value->start_date }}</td>
                                <td>{{ $value->end_date }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="align-middle">No Data</td>
                            </tr>
                        @endforelse
                    </table>
                    {{ $list->appends($filters)->links() }}
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
@endsection
