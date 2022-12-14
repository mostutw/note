@extends('adminlte::page')

@section('css')
<style>
    .list-box{
        padding: 0 20px 18px;
    }
</style>
@endsection

@section('content_header')
    <h1>
        {{-- Maintain List --}}
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        {{-- <li><a href="#">Pages</a></li> --}}
        <li class="active">Maintain List</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box list-box">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                    <div class="box-tools">
                        <form>
                            <div class="input-group">
                                <input type="text" name="table_search" class="form-control input-sm pull-right"
                                    style="width: 150px;" placeholder="Search content" />
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            {{-- <th class="text-nowrap text-center">#</th> --}}
                            <th class="text-nowrap">故障簡述</th>
                            <th class="text-nowrap">填單者</th>
                            <th class="text-nowrap">填單日</th>
                            <th class="text-nowrap">進度</th>
                            <th class="text-nowrap">檢修日</th>
                            <th class="text-nowrap">完工日</th>
                        </tr>
                        @forelse ($list as $value)
                            <tr>
                                {{-- <td class="text-nowrap text-center">{{ $value->id }}</td> --}}
                                <td><a href="{{ url('pages/maintains/' . $value->id) }}">{{ $value->title }}</a></td>
                                <td>{{ $value->user->name }}</td>
                                <td>{{ $value->created_at->format('m-d-Y') }}</td>
                                <td>{{ $value->status }}</td>
                                <td>@if(!is_null($value->start_date)){{ $value->start_date->format('m-d-Y') }}@endif</td>
                                <td>@if(!is_null($value->end_date)){{ $value->end_date->format('m-d-Y') }}@endif</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center">No Data</td>
                            </tr>
                        @endforelse
                    </table>
                    {{ $list->appends($filters)->links() }}
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
@endsection
