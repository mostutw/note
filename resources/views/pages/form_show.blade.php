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

    <title>{{ $itecFormData->form_info->title_name }} | {{ trans('info.company') }}</title>
    <style>
        @media (max-width: 767px) {
            .text-right { text-align:left }
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
                                <span>{{ $itecFormData->task_id }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- 內容 -->
                    @foreach ($a_form_data as $form_data)
                        <!-- Grid && Sum 不列印 -->
                        @if (!isset($form_data['Grid']) || !isset($form_data['Sum']))
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="col-sm-2 form-group text-right">
                                        <label class="form-label">{{ $form_data['Label'] }}</label>
                                    </div>
                                    <div class="col-sm-10 form-group">
                                        @switch($form_data['Type'])
                                            @case('text')
                                                @if (!$form_data['Grid'])
                                                    <span>{{ $form_data['value'] }}</span>
                                                @endif
                                            @break

                                            @case('upload')
                                                @foreach ($form_data['value'] as $val)
                                                    <span>
                                                        <a href="{{ env('IOA_URL') . $val }}"
                                                            target="_blank">{{ str_replace(env('IOA_UPLOAD_FILE_PATH'), '', $val) }}</a>
                                                    </span>
                                                @endforeach
                                            @break

                                            @case('editor')
                                                <span>{!! $form_data['value'] !!}</span>
                                            @break

                                            @default
                                                <span>{{ $form_data['value'] }}</span>
                                        @endswitch
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    <hr class="hr1">
                    <!-- 表格 -->
                    @foreach ($a_form_table as $form_table)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        @foreach ($form_table['title'] as $title)
                                            <th scope="col" class="text-nowrap">{{ $title }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($form_table['data'] as $key => $data)
                                        <tr>
                                            <th>{{ $key + 1 }}</th>
                                            @foreach ($data as $value)
                                                <td>{{ $value['value'] }}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                <tbody>
                            </table>
                        </div>
                    @endforeach

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
