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
        <li class="active">Resume List</li>
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
                                    style="width: 150px;" placeholder="Search..." value="{{ old('table_search', $filters['table_search']) }}" />
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th scope="col">姓名</th>
                            <th scope="col">電話</th>
                            <th scope="col">進度</th>
                            <th scope="col">人事資料表</th>
                            <th scope="col">狀態</th>
                            <th scope="col">提供給求職者</th>
                            <th scope="col">建立日期</th>
                            <th scope="col">修改日期</th>
                        </tr>
                        @forelse ($list as $value)
                            <tr>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->phone }}</td>
                                <td>{{ $select_list['resume_status'][$value->status] }}</td>
                                <td><a href="{{ url('pages/resumes/' . $value->id) . '/edit' }}" target="_blank">查看</a></td>
                                <td>{{ $select_list['resume_lock'][$value->lock] }}</td>
                                <td><a href="{{ url('public/resumes/' . $value->uuid . '/edit') }}" target="_blank">查看</a></td>
                                <td>{{ $value->created_at->format('m-d-Y H:i') }}</td>
                                <td>{{ $value->updated_at->format('m-d-Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="10">No Data</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $list->appends($filters)->links() }}
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
@endsection
