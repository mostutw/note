<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- boostrap -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- jquery -->
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="http://jqueryui.com/resources/demos/style.css">
    <!-- custom -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/resume.css') }}">

    <title>{{ $itecFormData->form_info->title_name }} - {{ $itecFormData->task_id }}</title>
    <style>
        .c-form-page {
            padding-bottom: 100px;
        }

        thead tr th {
            white-space: nowrap;
        }

        @media (max-width: 767px) {
            .text-right {
                text-align: left
            }
        }
    </style>
</head>

<body>
    <div class="container full">
        <div class="row c-form-page">
            <form role="form">
                <div class="col-sm-12 c-form-legend">
                    <p class="h2 text-center">{{ $itecFormData->form_info->title_name }}</p>
                </div>

                <div class="col-sm-12 form-column">
                    <!-- 單號 -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-2 form-group text-right">
                                <label class="form-label">{{ trans('form.id') }}</label>
                            </div>
                            <div class="col-sm-10 form-group">
                                <p class="text-primary">{{ $itecFormData->task_id }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- 主表 -->
                        @forelse ($masterForm as $item)
                            @if ($item['view'])
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="col-sm-2 form-group text-right">
                                        <label
                                            class="form-label @if ($item['Required'] == 'true') required @endif">{{ $item['Label'] }}</label>
                                    </div>
                                    <div class="col-sm-10 form-group">
                                        @switch($item['Type'])
                                            // systeminfo text select getvalue department
                                            @case('text')
                                                <p class=" @if ($item['redtext'] == true) text-danger @endif ">
                                                    {{ $item['value'] }}
                                                </p>
                                            @break

                                            @case('upload')
                                                @foreach ($item['value'] as $filePath)
                                                    <p>
                                                        <a href="{{ env('IOA_URL') . $filePath }}"
                                                            target="_blank">{{ str_replace(env('IOA_UPLOAD_FILE_PATH'), '', $filePath) }}</a>
                                                    </p>
                                                @endforeach
                                            @break

                                            @case('editor')
                                                <p>{!! $item['value'] !!}</p>
                                            @break

                                            @default
                                                <p class=" @if ($item['redtext'] == true) text-danger @endif ">
                                                    {{ $item['value'] }}
                                                </p>
                                        @endswitch
                                    </div>
                                </div>
                            </div>
                            @endif
                        @empty
                        @endforelse
                        <!-- 子表 -->
                        @if (!empty($slaveForm))
                            <hr>
                            @forelse ($slaveForm as $item)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                @foreach ($item['title'] as $title)
                                                    <th scope="col" class="text-nowrap">{{ $title }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($item['data'] as $key => $data)
                                                <tr>
                                                    <th scope="row" class="text-nowrap">
                                                        @if (count($item['data']) > $key + 1)
                                                            {{ $key + 1 }}
                                                        @else
                                                            {{ trans('form.total')}}
                                                        @endif
                                                    </th>
                                                    @foreach ($data as $field)
                                                        <td>{{ $field }}</td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        <tbody>
                                    </table>
                                </div>
                            @empty
                            @endforelse
                        @endif
                        {{-- 簽核歷程 --}}
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col">關卡</th>
                                        <th scope="col">簽核人</th>
                                        <th scope="col">簽核時間</th>
                                        <th scope="col">簽核結果</th>
                                        <th scope="col">簽核意見</th>
                                    </tr>
                                </thead>
                                @forelse ($formSignHistory as $item)
                                    <tbody>
                                        <tr>
                                            <th scope="row" class="text-center">{{ $item->version }}</th>
                                            <td>{{ $item->flow_stepname }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->event_date }}</td>
                                            <td>{{ $menu['sResult'][$item->sResult] }}</td>
                                            <td>{{ $item->sComment }}</td>
                                        </tr>
                                    <tbody>
                                    @empty
                                @endforelse
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-12 c-form-footer">
                        {{-- 底部 --}}
                    </div>
                </form>
            </div>
        </div>
        <!-- script -->
        <!-- jquery -->
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <!-- bootstrap -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- custom -->
        <script>
            // document loaded / window loaded
            $(document).ready(function() {

            });
            $(window).on("load", function() {
                // console.log("window loaded");
            });
        </script>

    </body>

    </html>
