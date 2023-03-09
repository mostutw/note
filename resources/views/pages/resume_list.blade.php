@extends('adminlte::page')

@section('css')
<style>
    .list-box{
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
                        <form>
                            <div class="input-group">
                                <input type="text" name="table_search" class="form-control input-sm pull-right"
                                    style="width: 150px;" placeholder="輸入姓名或電話..."
                                    value="{{ old('table_search', $filters['table_search']) }}" />
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
                                <th scope="col">狀態</th>
                                <th scope="col">公開連結</th>
                                <th scope="col">外部連結</th>
                                <th scope="col">建立日期</th>
                                <th scope="col">修改日期</th>
                                <th scope="col">匯出</th>
                            </tr>
                            @forelse ($list as $value)
                                <tr>
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
                                            <label class="form-check-label" for="inlineRadio">開</label>
                                            <input class="form-check-input lock-switch" type="radio"
                                                name="inlineRadioOptions_{{ $value->id }}"
                                                data-radioIndexId="{{ $value->id }}" data-radioValue="1" value="1"
                                                @if ($value->lock == 1) checked @endif>
                                            <label class="form-check-label" for="inlineRadio">關</label>
                                        </div>
                                    </td>
                                    <td>
                                        <span id="copy_{{ $value->id }}"
                                            style="display:none">{{ url('public/resumes/' . $value->uuid . '/edit') }}</span>
                                        <button
                                            onclick="copyToClipboard('#copy_{{ $value->id }}','{{ $value->name }}')"
                                            type="button" class="btn btn-sm btn-primary">複製</button>
                                    </td>
                                    <td>{{ $value->created_at->format('m-d-Y H:i') }}</td>
                                    <td>{{ $value->updated_at->format('m-d-Y H:i') }}</td>
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
                    {{ $list->appends($filters)->links() }}
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
@endsection
<!-- jquery -->
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<!-- custom -->
<script>
    $(document).ready(function() {
        console.log("document loaded");
        $(".lock-switch").on('click', function(e) {
            save_lock_status($(this).attr('data-radioIndexId'), $(this).attr('data-radioValue'));
        });

    });
    $(window).on("load", function() {
        console.log("window loaded");
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
        console.log($(this));

        var $temp = $('<input>');
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
        alert('已複製' + '「' + name + '」' + '的外部連結');
    }
</script>
