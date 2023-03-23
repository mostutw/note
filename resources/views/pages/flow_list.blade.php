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
                                    <input type="number" name="q_id" class="form-control input-sm pull-left"
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
                <div class="box-body table-responsive">
                    <table class="table table-hover">
                        <thead class="no-warp">
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col" class="text-center">{{ trans('flow.id') }}</th>
                                <th scope="col">{{ trans('flow.title_name') }}</th>
                                <th scope="col">{{ trans('flow.apply_name') }}</th>
                                <th scope="col">{{ trans('flow.flow_stepname') }}</th>
                                <th scope="col">{{ trans('flow.flow_sign_name') }}</th>
                                <th scope="col">{{ trans('flow.status') }}</th>
                                <th scope="col">{{ trans('flow.create_date') }}</th>
                                <th scope="col">{{ trans('flow.update_date') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($list as $key => $value)
                                <tr>
                                    <th scope="row" class="text-center">{{ $key + 1 }}</th>
                                    <td class="text-center">
                                        <a href="{{ url('pages/forms/' . $value['id'] ) }}" target="_blank">{{ $value['id'] }}</a>
                                    </td>
                                    <td>{{ $value['title_name'] }}</td>
                                    <td>{{ $value['name'] }}</td>
                                    <td>{{ $value['flow_stepname'] }}</td>
                                    <td>{{ $value['flow_sign_name'] }}</td>
                                    <td><a href="#" data-toggle="modal" data-target="#edit"
                                            data-id="{{ $value['id'] }}" data-titlename="{{ $value['title_name'] }}"
                                            data-stepname="{{ $value['flow_stepname'] }}"
                                            data-stepid="{{ $value['flow_stepid'] }}"
                                            data-signname="{{ $value['flow_sign_name'] }}"
                                            data-statusname="{{ $value['status_name'] }}"
                                            data-status="{{ $value['status'] }}">{{ $value['status_name'] }}</a></td>
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

    <!-- Modal -->
    <div class="modal fade" id="edit" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">title</h5>
                    <p id="task_id" style="display:none;"></p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group" id="show_stepname">
                            <label for="select_stepname">Step Name</label>
                            <select name="select_stepname" id="select_stepname"
                                class="form-control modal-select-select_stepname">
                            </select>
                        </div>
                        <div class="form-group" id="show_employees">
                            <label for="select_stepuser">Step User</label>
                            <select name="select_stepuser" id="select_stepuser"
                                class="form-control modal-select-stepuser">
                                <option value="">--</option>
                                @foreach ($employees as $key => $value)
                                    <option value="{{ $key }}">{{ $value['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id="show_status">
                            <label for="select_status">Status</label>
                            <select name="select_status" id="select_status" class="form-control modal-select-status">
                                <option value="">--</option>
                                <option value="4">完成</option>
                                <option value="16">駁回</option>
                                <option value="64">取消</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" name="save_changes" id="save_changes">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        // let token = $('meta[name="_token"]').attr('content');
        $('#edit').on('show.bs.modal', function(e) {
            //show.bs.modal = BS內建，觸發時執行
            let btn = $(e.relatedTarget); //抓取觸發按鈕的資料
            let data = {
                "id": btn.data('id'),
                "title": btn.data('titlename'), // 表單名稱
                "stepname": btn.data('stepname'), // 待簽核關卡名稱
                "stepid": btn.data('stepid'), // 待簽核關卡id
                "signname": btn.data('signname'), // 待簽人名稱
                "statusname": btn.data('statusname'), // 表單狀態名稱
                "status": btn.data('status') // 表單狀態id
            };

            let modal = $(this); //要修改的modal就是現在開啟的這個modal
            modal.find('.modal-title').text(data.title + ' : ' + data.id);
            modal.find('#task_id').text(data.id);
            $('#select_stepname').html('<option value="">--</option>');
            $('#select_stepuser').val('');
            $('#select_status').val('');
            // 取得簽核關卡清單
            $.ajax({
                type: 'get',
                url: 'flows/' + data.id + '/showStep'
            }).then(function(result) {
                console.log(result);
                let list = '';
                $.each((result), function(index, value) {
                    if (data.stepid == value.id) {
                        list += '<option value="' + value.id + '">' + value.id + ' - ' + value
                            .name + ' 「當前」' + '</option>';
                    } else {
                        list += '<option value="' + value.id + '">' + value.id + ' - ' + value
                            .name + '</option>';
                    }
                })
                $('#select_stepname').append(list);
            });
        });

        $('#save_changes').on('click', function() {
            let data = {
                "id": $('#task_id').text(),
                "step_id": $('#select_stepname').val(),
                "step_user_id": $('#select_stepuser').val(),
                "status": $('#select_status').val(),
            };
            // 異動更新
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                type: 'put',
                url: '/pages/flows/' + data.id + '/updateStep',
                data: data,
                dataType: "json",
                success: function(result) {
                    console.log(result);
                    $('#edit').modal('toggle');
                    location.reload();
                },
            });
        });
    </script>
@endpush
