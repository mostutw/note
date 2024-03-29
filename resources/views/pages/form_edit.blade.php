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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/all.min.css') }}">
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
            <form role="form" action="{{ url('pages/forms/' . $itecFormData->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('fail'))
                    <div class="alert alert-danger">
                        {{ session('fail') }}
                    </div>
                @endif
                <div class="col-sm-12 c-form-legend">
                    <p class="h2 text-center">{{ $itecFormData->form_info->title_name }} - {{ trans('form.id') }} : <a
                            href="{{ url('pages/forms/' . $itecFormData->task_id) }}">{{ $itecFormData->task_id }}</a>
                    </p>
                </div>

                <div class="col-md-12">
                    <button type="button" onclick="test()">Format XML</button>
                </div>

                <div class="col-md-12">
                    <!-- textarea -->
                    <div class="form-group text-center">
                        <label class="form-label"></label>

                        <textarea class="form-control" name="form_content" id="result" rows="20" placeholder="">{{ $itecFormData->form_content }}</textarea>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>

        <div class="col-sm-12 c-form-footer">

        </div>

        {{-- <textarea id="result" rows="8" cols="32"></textarea> --}}


    </div>
    <!-- script -->
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <!-- bootstrap -->
    <script src='https://cdn.tiny.cloud/1/hn3o0tmszhnrb0adtmub1316kgfdva1wwx1dcwivusv5n56a/tinymce/4/tinymce.min.js'>
    </script>
    <!-- custom -->
    <script>
        // document loaded / window loaded
        $(document).ready(function() {
            // console.log("window ready");
        });
        $(window).on("load", function() {
            // console.log("window loaded");
        });
    </script>
    <script>
        function test() {
            let res = document.getElementById('result');
            res.value = formatXml(res.value);
        }
        // 
        function formatXml(xml) {
            xml = new XMLSerializer().serializeToString(
                    new DOMParser().parseFromString(xml, 'text/xml'))
                .replace(/>\s{0,}</g, '><');
            const PADDING = ' '.repeat(2); // set desired indent size here
            const reg = /(>)(<)(\/*)/g;
            let pad = 0;
            xml = xml.replace(reg, '$1\r\n$2$3');
            return xml.split('\r\n').map((node, index) => {
                let indent = 0;
                if (node.match(/.+<\/\w[^>]*>$/)) {
                    indent = 0;
                } else if (node.match(/^<\/\w/) && pad > 0) {
                    pad -= 1;
                } else if (node.match(/^<\w[^>]*[^\/]>.*$/)) {
                    indent = 1;
                } else {
                    indent = 0;
                }
                pad += indent;
                return PADDING.repeat(pad - indent) + node;
            }).join('\r\n');
        }
    </script>

</body>

</html>
