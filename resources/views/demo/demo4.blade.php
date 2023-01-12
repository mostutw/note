<!DOCTYPE html>
<html class="bg-black">

<head>
    <meta charset="UTF-8">
    <title>Demo | Page</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    {{-- <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}"> --}}
    <!-- bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!-- font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/AdminLTE-custom.css') }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
</head>

<body class="bg-black">
    <div class="form-box container">
        <div class="header h3">整技科技 人事資料表</div>
        <div class="body bg-gray">
            <div class="col-dm-12">
                <div class="row">
                    <div class="col-sm-4">
                        <label for="inputDept" class="col-form-label">應徵部門</label>
                        <input type="text" class="form-control" id="inputDept" placeholder="">
                    </div>
                    <div class="col-sm-4">
                        <label for="inputJob" class="col-form-label">應徵職務</label>
                        <input type="text" class="form-control" id="inputJob" placeholder="">
                    </div>
                    <div class="col-sm-4">
                        <label for="inputWorkDate" class="col-form-label">可上班日</label>
                        <input type="date" class="form-control" id="inputWorkDate" placeholder="" value="2023-01-01">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="inputLowSalary" class="col-form-label">期望待遇</label>
                        <input type="number" class="form-control" id="inputLowSalary" placeholder="">
                    </div>
                    <div class="col-sm-4">
                        <label for="inputWorkDate" class="col-form-label">可接受最低待遇</label>
                        <input type="number" class="form-control" id="inputSalary" placeholder="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="inputChineseName" class="col-form-label">中文姓名</label>
                        <input type="text" class="form-control" id="inputChineseName" placeholder="">
                    </div>
                    <div class="col-sm-4">
                        <label for="inputEnglishName" class="col-form-label" >英文姓名</label>
                        <input type="text" class="form-control" id="inputEnglishName" placeholder="">
                    </div>
                    <div class="col-sm-4">
                        <label for="inputBirthday" class="col-form-label">生日</label>
                        <input type="date" class="form-control" id="inputBirthday" placeholder=""
                            value="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="inputId" class="col-form-label">身份證</label>
                        <input type="text" class="form-control" id="inputId" placeholder="">
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            {{-- <button type="submit" class="btn bg-olive btn-block">送出</button> --}}
        </div>
        <div class="margin text-center">
            <span>©2023 itec Systems Inc. Designed by <a href="mailto:mos.tu.tw@gmail.com.tw">MOS</a></span>
            <br />
            {{-- <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
            <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
            <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button> --}}
        </div>

    </div>


    <!-- jQuery 2.0.2 -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <!-- Bootstrap -->
    {{-- <script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script> --}}
    <!-- bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>
</body>

</html>
