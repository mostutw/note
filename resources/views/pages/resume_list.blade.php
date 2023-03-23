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
                                <th scope="col">{{ trans('resume.export') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($list as $key => $value)
                                <tr>
                                    <th scope="row" class="text-center">{{ $key + 1 }}</th>
                                    <td class="text-center">{{ $value->id }}</th>
                                    <td><a href="{{ url('pages/resumes/' . $value->id) . '/edit' }}"
                                            target="_blank">{{ $value->name }}</a></td>
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
                                    <td>{{ $value->created_at->format('m-d-Y H:i') }}</td>
                                    <td>{{ $value->updated_at->format('m-d-Y H:i') }}</td>
                                    <td>{{ $value->user->name }}</td>
                                    <td><a href="{{ url('pages/resumes/' . $value->id) . '/export' }}" target="_blank"><i
                                                class="fa fa-file-word"></i></a></td>
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

@push('js')
    <script>
        $(document).ready(function() {
            // console.log("document loaded");
            $(".lock-switch").on('click', function(e) {
                save_lock_status($(this).attr('data-radioIndexId'), $(this).attr('data-radioValue'));
            });

        });
        $(window).on("load", function() {
            // console.log("window loaded");
        });

        function save_lock_status(id, lock_status) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
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
