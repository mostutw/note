@extends('adminlte::page')

@section('css')
    <style>
        .list-box {
            padding: 0 20px 18px;
        }
        thead tr th {
            white-space: nowrap;
        }
        .hyper-link a:visited {
            color: Purple;
            background-color: transparent;
            text-decoration: none;
        }
    </style>
@endsection

@section('content_header')
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <h1>
        {{-- Maintain List --}}
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i>&nbsp{{ trans('info.home') }}</a></li>
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
                        <form role="form">
                            <div class="input-group">
                                <input type="text" name="table_search" class="form-control input-sm pull-right"
                                    style="width: 150px;" placeholder="Search..."
                                    value="{{ old('table_search', $filters['table_search']) }}" />
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
                                <th scope="col" class="text-center">{{ trans('resume.id') }}</th>
                                <th scope="col">{{ trans('resume.name') }}</th>
                                <th scope="col">{{ trans('resume.phone') }}</th>
                                <th scope="col">{{ trans('resume.status') }}</th>
                                <th scope="col">{{ trans('resume.link_button') }}</th>
                                <th scope="col">{{ trans('resume.public_link') }}</th>
                                <th scope="col">{{ trans('resume.created_at') }}</th>
                                <th scope="col">{{ trans('resume.updated_at') }}</th>
                                <th scope="col">{{ trans('resume.created_user') }}</th>
                                <th scope="col" class="text-center">{{ trans('resume.save') }}</th>
                                <th scope="col" class="text-center">{{ trans('resume.export') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($list as $key => $value)
                                <tr>
                                    <th scope="row" class="text-center">{{ $key + 1 }}</th>
                                    <td class="text-center hyper-link"><a href="{{ url('pages/resumes/' . $value->id) . '/edit' }}"
                                            target="_blank">{{ $value->id }}</a></th>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#edit"
                                            data-id="{{ $value->id }}" data-name="{{ $value->name }}"
                                            data-phone="{{ $value->phone }}">{{ $value->name }}
                                        </a>
                                    </td>
                                    <td>{{ $value->phoneFormat }}</td>
                                    <td>{{ $select_list['resume_status'][$value->status] }}</td>
                                    <td>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input lock-switch" type="radio"
                                                name="inlineRadioOptions_{{ $value->id }}"
                                                data-radioIndexId="{{ $value->id }}" data-radioValue="0" value="0"
                                                @if ($value->lock == 0) checked @endif>
                                            <label class="form-check-label"
                                                for="inlineRadio">{{ trans('resume.on') }}</label>
                                            <input class="form-check-input lock-switch" type="radio"
                                                name="inlineRadioOptions_{{ $value->id }}"
                                                data-radioIndexId="{{ $value->id }}" data-radioValue="1" value="1"
                                                @if ($value->lock == 1) checked @endif>
                                            <label class="form-check-label"
                                                for="inlineRadio">{{ trans('resume.off') }}</label>
                                        </div>
                                    </td>
                                    <td>
                                        <span id="copy_{{ $value->id }}"
                                            style="display:none">{{ url('public/resumes/' . $value->uuid . '/edit') }}</span>
                                        <button
                                            onclick="copyToClipboard('#copy_{{ $value->id }}','{{ $value->name }}')"
                                            type="button"
                                            class="btn btn-sm btn-primary">{{ trans('resume.copy') }}</button>
                                    </td>
                                    <td>{{ $value->created_at->format('m-d-Y') }}</td>
                                    <td>{{ $value->updated_at->diffForHumans() }}</td>
                                    <td>{{ $value->user->name }}</td>
                                    <td class="text-center">
                                        @if ($value->other_promise)
                                            <i class="fa fa-save"></i>
                                        @endif
                                    </td>
                                    <td class="text-center"><a href="{{ url('pages/resumes/' . $value->id) . '/export' }}"
                                            target="_blank"><i class="fa fa-file-word"></i></a></td>
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
            <form role="form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="changeId" value="">
                        <label class="label-control">{{ trans('resume.name') }}</label>
                        <input type="text" class="form-control" id="changeName" placeholder="" value="">
                        <br />
                        <label class="label-control">{{ trans('resume.phone') }}</label>
                        <input type="number" class="form-control" id="changePhone" placeholder="" value="">
                        <br />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" name="save_changes" id="save_changes">Save
                            changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            // console.log("document loaded");
            $(".lock-switch").on('click', function(e) {
                save_lock_status($(this).attr('data-radioIndexId'), $(this).attr('data-radioValue'));
            });
            $("#save_changes").on('click', function(e) {
                let data = {
                    "id": $('#changeId').val(),
                    "name": $('#changeName').val(),
                    "phone": $('#changePhone').val(),
                };
                save_profile(data);
            });
            $('#edit').on('show.bs.modal', function(e) {
                //show.bs.modal = BS內建，觸發時執行
                let btn = $(e.relatedTarget); //抓取觸發按鈕的資料
                let data = {
                    "id": btn.data('id'),
                    "name": btn.data('name'),
                    "phone": btn.data('phone'),
                };
                // console.log(data);
                let modal = $(this); //要修改的modal就是現在開啟的這個modal
                modal.find('#changeId').val(data.id); // 異動 modal
                modal.find('#changeName').val(data.name);
                modal.find('#changePhone').val(data.phone);
            });
        });

        $(window).on("load", function() {
            // console.log("window loaded");
        });

        function save_profile(data) {
            // console.log(data);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "put",
                url: './resumes/' + data.id + '/updateProfile',
                data: data,
                success: function(data) {
                    console.log(data);
                    location.reload();
                }
            })
        }

        function save_lock_status(id, lock_status) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "put",
                url: './resumes/' + id + '/updateLock',
                data: {
                    id: id,
                    lock: lock_status,
                },
                success: function(data) {
                    console.log(data);
                }
            })
        }

        function copyToClipboard(element, name) {
            // console.log($(this));
            var $temp = $('<input>');
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
            alert('已複製' + '「' + name + '」' + '的外部連結');
        }
    </script>
@endpush
