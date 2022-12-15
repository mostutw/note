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
        {{-- User List --}}
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
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
                        <form>
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
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">使用者名稱</th>
                            <th scope="col">電子郵件地址</th>
                            <th scope="col">建立時間</th>
                            <th scope="col">更新時間</th>
                        </tr>
                        @forelse ($list as $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->name }}</td>
                                <td><a href="{{ url('pages/users/' . $value->id) }}">{{ $value->email }}</a></td>
                                <td>{{ $value->created_at}}</td>
                                <td>{{ $value->updated_at}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="10">No Data</td>
                            </tr>
                        @endforelse
                    </table>
                    {{ $list->appends($filters)->links() }}
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
@endsection
