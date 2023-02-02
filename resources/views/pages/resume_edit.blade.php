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

    <title>人事資料表 | 整技科技股份有限公司</title>
</head>

<body>
    <div class="container full">
        <div class="row c-form-page">
            <form role="form" action="{{ url($url) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div>
                    <img src="{{ asset('img/banner.png') }}" class="c-img-banner" alt="">
                </div>
                <div class="col-sm-12 c-form-legend">
                    <p class="h2 text-center">整技科技 人事資料表</p>
                </div>

                <div class="col-sm-12 form-column">
                    <!-- 應徵資訊 -->
                    <div class="row">
                        <div class="col-md-2 col-sm-12 c-img-circle">
                            <img src="{{ asset('img/user-photo.png') }}" class="c-circle" name="info_user_photo"
                                id="info_user_photo">
                            {{-- <input type="file" id="upload_user_photo" name="upload_user_photo" accept="image/*"
                                onchange="readURL(this);" style="display:none"> --}}
                        </div>
                        <div class="col-md-10">
                            <div class="form-group col-md-4">
                                <label for="interview_department">應徵部門</label>
                                <input type="text" value="{{ $query['interview_department'] }}"
                                    name="interview_department" id="interview_department" class="form-control"
                                    placeholder="研發部">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="interview_jobTitle">應徵職位</label>
                                <input type="text" value="{{ $query['interview_jobTitle'] }}"
                                    name="interview_jobTitle" id="interview_jobTitle" class="form-control"
                                    placeholder="專案經理">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="interview_workDate">最快可上班日期</label>
                                <input type="date" value="{{ $query['interview_workDate'] }}"
                                    name="interview_workDate" id="interview_workDate" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="interview_salary">期望待遇</label>
                                <input type="number" value="{{ $query['interview_salary'] }}" name="interview_salary"
                                    id="interview_salary" class="form-control" placeholder="60000">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="interview_lowSalary">最低可接受月薪</label>
                                <input type="number" value="{{ $query['interview_lowSalary'] }}"
                                    name="interview_lowSalary" id="interview_lowSalary" class="form-control"
                                    placeholder="58000">
                            </div>
                        </div>
                    </div>
                    <!-- 個人基本資料 -->
                    <p class="h3">基本資料</p>
                    <hr>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="info_chineseName" class="required">中文姓名</label>
                            <input type="text" value="{{ $query['info_chineseName'] }}" name="info_chineseName"
                                id="info_chineseName" class="form-control" placeholder="陳米" required="true">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="info_englishName">英文姓名</label>
                            <input type="text" value="{{ $query['info_englishName'] }}" name="info_englishName"
                                id="info_englishName" class="form-control" placeholder="Mi Chen">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="info_sex" class="select required">性別</label>
                            <select class="form-control form-select" name="info_sex" id="info_sex" required="true">
                                <option value="">請選擇</option>
                                <option value="1" @if ($query['info_sex'] == 1) selected @endif>男</option>
                                <option value="2" @if ($query['info_sex'] == 2) selected @endif>女</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="info_marry">婚姻</label>
                            <select class="form-control form-select" name="info_marry" id="info_marry">
                                <option value="">請選擇</option>
                                <option value="1" @if ($query['info_marry'] == 1) selected @endif>單身</option>
                                <option value="2" @if ($query['info_marry'] == 2) selected @endif>已婚</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="info_id">身份證字號</label>
                            <input type="text" value="{{ $query['info_id'] }}" name="info_id" id="info_id"
                                class="form-control text-uppercase" placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="info_birthday">出生年月日</label>
                            <input type="date" value="{{ $query['info_birthday'] }}" name="info_birthday"
                                id="info_birthday" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="info_birthplace">出生地</label>
                            <input type="text" value="{{ $query['info_birthplace'] }}" name="info_birthplace"
                                id="info_birthplace" class="form-control" placeholder="臺灣省桃園縣">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="info_height">身高(cm)</label>
                            <input type="number" value="{{ $query['info_height'] }}" name="info_height"
                                id="info_height" class="form-control" placeholder="180">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="info_weight">體重(kg)</label>
                            <input type="number" value="{{ $query['info_weight'] }}" name="info_weight"
                                id="info_weight"" class="form-control" placeholder="80">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="info_blood">血型</label>
                            <select class="form-control form-select" name="info_blood" id="info_blood">
                                <option value="">請選擇</option>
                                <option value="A" @if ($query['info_blood'] == 'A') selected @endif>A</option>
                                <option value="B" @if ($query['info_blood'] == 'B') selected @endif>B</option>
                                <option value="AB" @if ($query['info_blood'] == 'AB') selected @endif>AB</option>
                                <option value="O" @if ($query['info_blood'] == 'O') selected @endif>O</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="info_colorPerception">辨色力</label>
                            <select class="form-control form-select" name="info_colorPerception"
                                id="info_colorPerception">
                                <option value="">請選擇</option>
                                <option value="1" @if ($query['info_colorPerception'] == 1) selected @endif>正常</option>
                                <option value="2" @if ($query['info_colorPerception'] == 2) selected @endif>色盲</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="info_visionLeft">視力(左)</label>
                            <input type="number" value="{{ $query['info_visionLeft'] }}" name="info_visionLeft"
                                id="info_visionLeft" class="form-control" placeholder="1.0">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="info_visionRight">視力(右)</label>
                            <input type="number" value="{{ $query['info_visionRight'] }}" name="info_visionRight"
                                id="info_visionRight" class="form-control" placeholder="1.0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="info_disability">身心障礙</label>
                            <select class="form-control form-select" name="info_disability" id="info_disability">
                                <option value="">請選擇</option>
                                <option value="1" @if ($query['info_disability'] == 1) selected @endif>是</option>
                                <option value="2" @if ($query['info_disability'] == 2) selected @endif>否</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="info_disabilityType">類別</label>
                            <input type="text" value="{{ $query['info_disabilityType'] }}"
                                name="info_disabilityType" id="info_disabilityType" class="form-control"
                                placeholder="" disabled="disabled">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="info_disabilityLevel">程度</label>
                            <input type="text" value="{{ $query['info_disabilityLevel'] }}"
                                name="info_disabilityLevel" id="info_disabilityLevel" class="form-control"
                                placeholder="" disabled="disabled">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="info_military">兵役狀況</label>
                            <select class="form-control form-select" name="info_military" id="info_military">
                                <option value="">請選擇</option>
                                <option value="1" @if ($query['info_military'] == 1) selected @endif>役畢</option>
                                <option value="2" @if ($query['info_military'] == 2) selected @endif>免役</option>
                                <option value="3" @if ($query['info_military'] == 3) selected @endif>待役</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="info_militaryDate">退伍日期</label>
                            <input type="date" value="{{ $query['info_militaryDate'] }}" name="info_militaryDate"
                                id="info_militaryDate" class="form-control" disabled="disabled">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="info_militaryReason">免役原因</label>
                            <input type="text" value="{{ $query['info_militaryReason'] }}"
                                name="info_militaryReason" id="info_militaryReason" class="form-control"
                                placeholder="" disabled="disabled">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label for="info_email">郵件信箱</label>
                            <input type="email" value="{{ $query['info_email'] }}" name="info_email"
                                id="info_email" class="form-control" placeholder="EMail">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="info_phone" class="required">手機號碼</label>
                            <input type="number" value="{{ $query['info_phone'] }}" name="info_phone"
                                id="info_phone" class="form-control" placeholder="0900123456" required="true">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label for="info_address">戶籍地址</label>
                            <input type="text" value="{{ $query['info_address'] }}" name="info_address"
                                id="info_address" class="form-control" placeholder="桃園市桃園區中正路1071號">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="info_telephone">戶籍電話</label>
                            <input type="number" value="{{ $query['info_telephone'] }}" name="info_telephone"
                                id="info_telephone" class="form-control" placeholder="033587899">
                        </div>
                        <div class="form-group col-md-8">
                            <label for="info_address_2">通訊地址</label>
                            <input type="text" value="{{ $query['info_address_2'] }}" name="info_address_2"
                                id="info_address_2" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="info_telephone_2">通訊電話</label>
                            <input type="number" value="{{ $query['info_telephone_2'] }}" name="info_telephone_2"
                                id="info_telephone_2" class="form-control" placeholder="">
                        </div>
                    </div>
                    <!-- 教育背景及專業課程 -->
                    <p class="h3">教育背景</p>
                    <hr>
                    {{-- <div class="row">
                        <div class="form-group col-md-4">
                            <label for="education[0][schoolLevel]" class="required">最高學歷</label>
                            <select class="form-control form-select" name="education[0][schoolLevel]"
                                id="education0schoolLevel" required="true">
                                <option value="">請選擇</option>
                                <option value="12" @if ($education[0]['schoolLevel'] == 12) selected @endif>博士</option>
                                <option value="11" @if ($education[0]['schoolLevel'] == 11) selected @endif>碩士</option>
                                <option value="10" @if ($education[0]['schoolLevel'] == 10) selected @endif>大學</option>
                                <option value="9" @if ($education[0]['schoolLevel'] == 9) selected @endif>四技</option>
                                <option value="8" @if ($education[0]['schoolLevel'] == 8) selected @endif>二技</option>
                                <option value="7" @if ($education[0]['schoolLevel'] == 7) selected @endif>二專</option>
                                <option value="6" @if ($education[0]['schoolLevel'] == 6) selected @endif>三專</option>
                                <option value="5" @if ($education[0]['schoolLevel'] == 5) selected @endif>五專</option>
                                <option value="4" @if ($education[0]['schoolLevel'] == 4) selected @endif>高中</option>
                                <option value="3" @if ($education[0]['schoolLevel'] == 3) selected @endif>高職</option>
                                <option value="2" @if ($education[0]['schoolLevel'] == 2) selected @endif>國中</option>
                                <option value="1" @if ($education[0]['schoolLevel'] == 1) selected @endif>國小</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="education[0][schoolName]" class="required">學校名稱</label>
                            <input type="text" value="{{ $education[0]['schoolName'] }}"
                                name="education[0][schoolName]" class="form-control" placeholder="" required="true">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="education[0][schoolDepartment]" class="required">科系名稱</label>
                            <input type="text" value="{{ $education[0]['schoolDepartment'] }}"
                                name="education[0][schoolDepartment]" class="form-control" placeholder=""
                                required="true">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="education[0][schoolStatus]" class="required">就學狀態</label>
                            <select class="form-control form-select" name="education[0][schoolStatus]"
                                required="true">
                                <option value="">請選擇</option>
                                <option value="1" @if ($education[0]['schoolStatus'] == 1) selected @endif>畢業</option>
                                <option value="2" @if ($education[0]['schoolStatus'] == 2) selected @endif>肄業</option>
                                <option value="3" @if ($education[0]['schoolStatus'] == 3) selected @endif>就學中</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="education[0][schoolStartDate]" class="required">就學期間</label>
                            <input type="month" value="{{ $education[0]['schoolStartDate'] }}"
                                name="education[0][schoolStartDate]" class="form-control" required="true">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="education[0][schoolEndDate]">&nbsp;</label>
                            <input type="month" value="{{ $education[0]['schoolEndDate'] }}"
                                name="education[0][schoolEndDate]" class="form-control" required="true">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="education[0][schoolThesisTopic]">論文題目</label>
                            <input type="text" value="{{ $education[0]['schoolThesisTopic'] }}"
                                name="education[0][schoolThesisTopic]" id="education0schoolThesisTopic"
                                class="form-control" placeholder="">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="education[1][schoolLevel]">次高學歷</label>
                            <select class="form-control form-select" name="education[1][schoolLevel]"
                                id="education1schoolLevel">
                                <option value="">請選擇</option>
                                <option value="12" @if ($education[1]['schoolLevel'] == 12) selected @endif>博士</option>
                                <option value="11" @if ($education[1]['schoolLevel'] == 11) selected @endif>碩士</option>
                                <option value="10" @if ($education[1]['schoolLevel'] == 10) selected @endif>大學</option>
                                <option value="9" @if ($education[1]['schoolLevel'] == 9) selected @endif>四技</option>
                                <option value="8" @if ($education[1]['schoolLevel'] == 8) selected @endif>二技</option>
                                <option value="7" @if ($education[1]['schoolLevel'] == 7) selected @endif>二專</option>
                                <option value="6" @if ($education[1]['schoolLevel'] == 6) selected @endif>三專</option>
                                <option value="5" @if ($education[1]['schoolLevel'] == 5) selected @endif>五專</option>
                                <option value="4" @if ($education[1]['schoolLevel'] == 4) selected @endif>高中</option>
                                <option value="3" @if ($education[1]['schoolLevel'] == 3) selected @endif>高職</option>
                                <option value="2" @if ($education[1]['schoolLevel'] == 2) selected @endif>國中</option>
                                <option value="1" @if ($education[1]['schoolLevel'] == 1) selected @endif>國小</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="education[1][schoolName]">學校名稱</label>
                            <input type="text" value="{{ $education[1]['schoolName'] }}" name="education[1][schoolName]"
                                class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="education[1][schoolDepartment]">科系名稱</label>
                            <input type="text" value="{{ $education[1]['schoolDepartment'] }}" name="education[1][schoolDepartment]"
                                class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="education[1][schoolStatus]">就學狀態</label>
                            <select class="form-control form-select" name="education[1][schoolStatus]">
                                <option value="">請選擇</option>
                                <option value="1" @if ($education[1]['schoolStatus'] == 1) selected @endif>畢業</option>
                                <option value="2" @if ($education[1]['schoolStatus'] == 2) selected @endif>肄業</option>
                                <option value="3" @if ($education[1]['schoolStatus'] == 3) selected @endif>就學中</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="education[1][schoolStartDate]">就學期間</label>
                            <input type="month" value="{{ $education[1]['schoolStartDate'] }}" name="education[1][schoolStartDate]"
                                class="form-control">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="education[1][schoolEndDate]">&nbsp;</label>
                            <input type="month" value="{{ $education[1]['schoolEndDate'] }}" name="education[1][schoolEndDate]"
                                class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="education[0][schoolThesisTopic]">論文題目</label>
                            <input type="text" value="{{ $education[1]['schoolThesisTopic'] }}" name="education[1][schoolThesisTopic]"
                                id="education1schoolThesisTopic" class="form-control" placeholder="">
                        </div>
                    </div> --}}
                    <br>
                    
                    <!-- 工作經歷 -->
                    <p class="h3">工作經歷</p>
                    <hr>
                    <!-- 工作一 -->
                    <div class="row ex0">
                        <div class="form-group col-md-4">
                            <label for="exp[0][companyName]">公司名稱</label>
                            <input type="text" value="{{ $exp[0]['companyName'] }}" name="exp[0][companyName]" class="form-control"
                                placeholder="大豐科技">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[0][companyDepartment]">部門</label>
                            <input type="text" value="{{ $exp[0]['companyDepartment'] }}" name="exp[0][companyDepartment]"
                                class="form-control" placeholder="資訊部">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[0][jobTitle]">職稱</label>
                            <input type="text" value="{{ $exp[0]['jobTitle'] }}" name="exp[0][jobTitle]" class="form-control"
                                placeholder="工程師">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[0][workPlace]">工作地點</label>
                            <input type="text" value="{{ $exp[0]['workPlace'] }}" name="exp[0][workPlace]" class="form-control"
                                placeholder="台北">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[0][startDate]">任職期間</label>
                            <input type="month" value="{{ $exp[0]['startDate'] }}" name="exp[0][startDate]" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[0][endDate]">&nbsp;</label>
                            <input type="month" value="{{ $exp[0]['endDate'] }}" name="exp[0][endDate]" class="form-control">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="exp[0][content]">工作描述</label>
                            <textarea class="form-control" name="exp[0][content]" rows="6" placeholder="描述工作內容...">{{ $exp[0]['content'] }}</textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exp[0][leaveReson]">離職原因</label>
                            <input type="text" value="{{ $exp[0]['leaveReson'] }}" name="exp[0][leaveReson]" class="form-control"
                                placeholder="">
                        </div>
                        <hr>
                    </div>

                    <!-- 工作二 -->
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseEx1"
                        aria-expanded="false" aria-controls="collapseEx1">+</button>
                    <div class="row collapse" id="collapseEx1">
                        <hr>
                        <div class="form-group col-md-4">
                            <label for="exp[1][companyName]">公司名稱</label>
                            <input type="text" value="{{ $exp[1]['companyName'] }}" name="exp[1][companyName]" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[1][companyDepartment]">部門</label>
                            <input type="text" value="{{ $exp[1]['companyDepartment'] }}" name="exp[1][companyDepartment]"
                                class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[1][jobTitle]">職稱</label>
                            <input type="text" value="{{ $exp[1]['jobTitle'] }}" name="exp[1][jobTitle]" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[1][workPlace]">工作地點</label>
                            <input type="text" value="{{ $exp[1]['workPlace'] }}" name="exp[1][workPlace]" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[1][startDate]">任職期間</label>
                            <input type="month" value="{{ $exp[1]['startDate'] }}" name="exp[1][startDate]" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[1][endDate]">&nbsp;</label>
                            <input type="month" value="{{ $exp[1]['endDate'] }}" name="exp[1][endDate]" class="form-control">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="exp[1][content]">工作描述</label>
                            <textarea class="form-control" name="exp[1][content]" rows="6" placeholder="描述工作內容...">{{ $exp[1]['content'] }}</textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exp[1][leaveReson]">離職原因</label>
                            <input type="text" value="{{ $exp[1]['leaveReson'] }}" name="exp[1][leaveReson]" class="form-control"
                                placeholder="">
                        </div>
                        <hr>
                    </div>

                    <!-- 工作三 -->
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseEx2"
                        aria-expanded="false" aria-controls="collapseEx2">+</button>
                    <div class="row collapse" id="collapseEx2">
                        <hr>
                        <div class="form-group col-md-4">
                            <label for="exp[2][companyName]">公司名稱</label>
                            <input type="text" value="{{ $exp[2]['companyName'] }}" name="exp[2][companyName]" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[2][companyDepartment]">部門</label>
                            <input type="text" value="{{ $exp[2]['companyDepartment'] }}" name="exp[2][companyDepartment]"
                                class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[2][jobTitle]">職稱</label>
                            <input type="text" value="{{ $exp[2]['jobTitle'] }}" name="exp[2][jobTitle]" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[2][workPlace]">工作地點</label>
                            <input type="text" value="{{ $exp[2]['workPlace'] }}" name="exp[2][workPlace]" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[2][startDate]">任職期間</label>
                            <input type="month" value="{{ $exp[2]['startDate'] }}" name="exp[2][startDate]" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[2][endDate]">&nbsp;</label>
                            <input type="month" value="{{ $exp[2]['endDate'] }}" name="exp[2][endDate]" class="form-control">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="exp[2][content]">工作描述</label>
                            <textarea class="form-control" name="exp[2][content]" rows="6" placeholder="描述工作內容...">{{ $exp[2]['content'] }}</textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exp[2][leaveReson]">離職原因</label>
                            <input type="text" value="{{ $exp[2]['leaveReson'] }}" name="exp[2][leaveReson]" class="form-control"
                                placeholder="">
                        </div>
                        <hr>
                    </div>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseEx3"
                        aria-expanded="false" aria-controls="collapseEx3">+</button>
                    <!-- 工作四 -->
                    <div class="row collapse" id="collapseEx3">
                        <hr>
                        <div class="form-group col-md-4">
                            <label for="exp[3][companyName]">公司名稱</label>
                            <input type="text" value="{{ $exp[3]['companyName'] }}" name="exp[3][companyName]" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[3][companyDepartment]">部門</label>
                            <input type="text" value="{{ $exp[3]['companyDepartment'] }}" name="exp[3][companyDepartment]"
                                class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[3][jobTitle]">職稱</label>
                            <input type="text" value="{{ $exp[3]['jobTitle'] }}" name="exp[3][jobTitle]" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[3][workPlace]">工作地點</label>
                            <input type="text" value="{{ $exp[3]['workPlace'] }}" name="exp[3][workPlace]" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[3][startDate]">任職期間</label>
                            <input type="month" value="{{ $exp[3]['startDate'] }}" name="exp[3][startDate]" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[3][endDate]">&nbsp;</label>
                            <input type="month" value="{{ $exp[3]['endDate'] }}" name="exp[3][endDate]" class="form-control">
                        </div>

                        <div class="form-group col-md-13">
                            <label for="exp[3][content]">工作描述</label>
                            <textarea class="form-control" name="exp[3][content]" rows="6" placeholder="描述工作內容...">{{ $exp[3]['content'] }}</textarea>
                        </div>
                        <div class="form-group col-md-13">
                            <label for="exp[3][leaveReson]">離職原因</label>
                            <input type="text" value="{{ $exp[3]['leaveReson'] }}" name="exp[3][leaveReson]" class="form-control"
                                placeholder="">
                        </div>
                        <hr>
                    </div>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseEx4"
                        aria-expanded="false" aria-controls="collapseEx4">+</button>
                    <!-- 工作五 -->
                    <div class="row collapse" id="collapseEx4">
                        <hr>
                        <div class="form-group col-md-4">
                            <label for="exp[4][companyName]">公司名稱</label>
                            <input type="text" value="{{ $exp[4]['companyName'] }}" name="exp[4][companyName]" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[4][companyDepartment]">部門</label>
                            <input type="text" value="{{ $exp[4]['companyDepartment'] }}" name="exp[4][companyDepartment]"
                                class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[4][jobTitle]">職稱</label>
                            <input type="text" value="{{ $exp[4]['jobTitle'] }}" name="exp[4][jobTitle]" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[4][workPlace]">工作地點</label>
                            <input type="text" value="{{ $exp[4]['workPlace'] }}" name="exp[4][workPlace]" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[4][startDate]">任職期間</label>
                            <input type="month" value="{{ $exp[4]['startDate'] }}" name="exp[4][startDate]" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[4][endDate]">&nbsp;</label>
                            <input type="month" value="{{ $exp[4]['endDate'] }}" name="exp[4][endDate]" class="form-control">
                        </div>

                        <div class="form-group col-md-14">
                            <label for="exp[4][content]">工作描述</label>
                            <textarea class="form-control" name="exp[4][content]" rows="6" placeholder="描述工作內容...">{{ $exp[4]['content'] }}</textarea>
                        </div>
                        <div class="form-group col-md-14">
                            <label for="exp[4][leaveReson]">離職原因</label>
                            <input type="text" value="{{ $exp[4]['leaveReson'] }}" name="exp[4][leaveReson]" class="form-control"
                                placeholder="">
                        </div>
                        <hr>
                    </div>
                    <br>
                    {{-- <button type="button" class="btn btn-primary" id="addEx">新增工作經歷</button> --}}
                    <!-- 個人特質/專業能力 -->
                    <p class="h3">專業能力</p>
                    <hr>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="feature_strength">優點</label>
                            <input type="text" value="{{ $query['feature_strength'] }}" name="feature_strength" id="feature_strength"
                                class="form-control" placeholder="做事細心">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="feature_weakness">缺點</label>
                            <input type="text" value="{{ $query['feature_weakness'] }}" name="feature_weakness" id="feature_weakness"
                                class="form-control" placeholder="個性急躁">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="feature_englishLevel">英文</label>
                            <select class="form-control form-select" name="feature_englishLevel"
                                id="feature_englishLevel">
                                <option value="">請選擇</option>
                                <option value="1" @if ($query['feature_englishLevel'] == 1) selected @endif>精通</option>
                                <option value="2" @if ($query['feature_englishLevel'] == 2) selected @endif>中等</option>
                                <option value="3" @if ($query['feature_englishLevel'] == 3) selected @endif>略懂</option>
                                <option value="4" @if ($query['feature_englishLevel'] == 4) selected @endif>不懂</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="feature_taiwaneseHokkienLevel">台語</label>
                            <select class="form-control form-select" name="feature_taiwaneseHokkienLevel"
                                id="feature_taiwaneseHokkienLevel">
                                <option value="">請選擇</option>
                                <option value="1" @if ($query['feature_taiwaneseHokkienLevel'] == 1) selected @endif>精通</option>
                                <option value="2" @if ($query['feature_taiwaneseHokkienLevel'] == 2) selected @endif>中等</option>
                                <option value="3" @if ($query['feature_taiwaneseHokkienLevel'] == 3) selected @endif>略懂</option>
                                <option value="4" @if ($query['feature_taiwaneseHokkienLevel'] == 4) selected @endif>不懂</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="feature_license">專業證照</label>
                        <textarea class="form-control" name="feature_license" id="feature_license" rows="3"
                            placeholder="Google Cloud Digital Leader, AWS Certified Solutions Architect – Associate">{{ $query['feature_license'] }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="feature_skill">專業技能</label>
                        <textarea class="form-control" name="feature_skill" id="feature_skill" rows="3"
                            placeholder="C#, ASP.NET, MSSQL, Git">{{ $query['feature_skill'] }}</textarea>
                    </div>

                    <!-- 家庭狀況 -->
                    <p class="h3">家庭狀況</p>
                    <hr>

                    <!-- 第1位 -->
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="family0title">稱謂</label>
                            <input type="text" value="{{ $family[0]['title'] }}" name="family[0][title]" class="form-control"
                                id="family0title" placeholder="父">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family0name">姓名</label>
                            <input type="text" value="{{ $family[0]['name'] }}" name="family[0][name]" class="form-control"
                                id="family0name" placeholder="陳大米">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family0age">年齡</label>
                            <input type="number" value="{{ $family[0]['age'] }}" name="family[0][age]" class="form-control"
                                id="family0age" placeholder="70">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family0job">職業</label>
                            <input type="text" value="{{ $family[0]['job'] }}" name="family[0][job]" class="form-control"
                                id="family0job" placeholder="退休">
                        </div>
                    </div>

                    <!-- 第2位 -->
                    <button class="btn btn-primary" type="button" data-toggle="collapse"
                        data-target="#collapseFamily1" aria-expanded="false"
                        aria-controls="collapseFamily1">+</button>
                    <div class="row collapse" id="collapseFamily1">
                        <hr>
                        <div class="form-group col-md-2">
                            <label for="family1title">稱謂</label>
                            <input type="text" value="{{ $family[1]['title'] }}" name="family[1][title]" class="form-control"
                                id="family1title" placeholder="父">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family1name">姓名</label>
                            <input type="text" value="{{ $family[1]['name'] }}" name="family[1][name]" class="form-control"
                                id="family1name" placeholder="陳大米">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family1age">年齡</label>
                            <input type="number" value="{{ $family[1]['age'] }}" name="family[1][age]" class="form-control"
                                id="family1age" placeholder="71">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family1job">職業</label>
                            <input type="text" value="{{ $family[1]['job'] }}" name="family[1][job]" class="form-control"
                                id="family1job" placeholder="退休">
                        </div>
                    </div>

                    <!-- 第3位 -->
                    <button class="btn btn-primary" type="button" data-toggle="collapse"
                        data-target="#collapseFamily2" aria-expanded="false"
                        aria-controls="collapseFamily2">+</button>
                    <div class="row collapse" id="collapseFamily2">
                        <hr>
                        <div class="form-group col-md-2">
                            <label for="family2title">稱謂</label>
                            <input type="text" value="{{ $family[2]['title'] }}" name="family[2][title]" class="form-control"
                                id="family2title" placeholder="父">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family2name">姓名</label>
                            <input type="text" value="{{ $family[2]['name'] }}" name="family[2][name]" class="form-control"
                                id="family2name" placeholder="陳大米">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family2age">年齡</label>
                            <input type="number" value="{{ $family[2]['age'] }}" name="family[2][age]" class="form-control"
                                id="family2age" placeholder="72">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family2job">職業</label>
                            <input type="text" value="{{ $family[2]['job'] }}" name="family[2][job]" class="form-control"
                                id="family2job" placeholder="退休">
                        </div>
                    </div>

                    <!-- 第4位 -->
                    <button class="btn btn-primary" type="button" data-toggle="collapse"
                        data-target="#collapseFamily3" aria-expanded="false"
                        aria-controls="collapseFamily3">+</button>
                    <div class="row collapse" id="collapseFamily3">
                        <hr>
                        <div class="form-group col-md-2">
                            <label for="family3title">稱謂</label>
                            <input type="text" value="{{ $family[3]['title'] }}" name="family[3][title]" class="form-control"
                                id="family3title" placeholder="父">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family3name">姓名</label>
                            <input type="text" value="{{ $family[3]['name'] }}" name="family[3][name]" class="form-control"
                                id="family3name" placeholder="陳大米">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family3age">年齡</label>
                            <input type="number" value="{{ $family[3]['age'] }}" name="family[3][age]" class="form-control"
                                id="family3age" placeholder="72">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family3job">職業</label>
                            <input type="text" value="{{ $family[3]['job'] }}" name="family[3][job]" class="form-control"
                                id="family3job" placeholder="退休">
                        </div>
                    </div>

                    <!-- 第5位 -->
                    <button class="btn btn-primary" type="button" data-toggle="collapse"
                        data-target="#collapseFamily4" aria-expanded="false"
                        aria-controls="collapseFamily4">+</button>
                    <div class="row collapse" id="collapseFamily4">
                        <hr>
                        <div class="form-group col-md-2">
                            <label for="family4title">稱謂</label>
                            <input type="text" value="{{ $family[4]['title'] }}" name="family[4][title]" class="form-control"
                                id="family4title" placeholder="父">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family4name">姓名</label>
                            <input type="text" value="{{ $family[4]['name'] }}" name="family[4][name]" class="form-control"
                                id="family4name" placeholder="陳大米">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family4age">年齡</label>
                            <input type="number" value="{{ $family[4]['age'] }}" name="family[4][age]" class="form-control"
                                id="family4age" placeholder="72">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family4job">職業</label>
                            <input type="text" value="{{ $family[4]['job'] }}" name="family[4][job]" class="form-control"
                                id="family4job" placeholder="退休">
                        </div>
                    </div>
                    <!-- 緊急聯絡 -->
                    <div class="row">
                        <hr>
                        <div class="form-group col-md-2">
                            <label for="family_emergencyContactName">緊急聯絡人</label>
                            <input type="text" value="{{ $query['family_emergencyContactName'] }}" name="family_emergencyContactName"
                                id="family_emergencyContactName" class="form-control" placeholder="黃大城">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family_emergencyContactPhone">電話</label>
                            <input type="number" value="{{ $query['family_emergencyContactPhone'] }}" name="family_emergencyContactPhone"
                                id="family_emergencyContactPhone" class="form-control" placeholder="0982888999">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family_emergencyContactRelation">關係</label>
                            <input type="text" value="{{ $query['family_emergencyContactRelation'] }}" name="family_emergencyContactRelation"
                                id="family_emergencyContactRelation" class="form-control" placeholder="">
                        </div>
                    </div>
                    <!-- 推薦人 -->
                    <p class="h3">推薦人</p>
                    <hr>
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="recommend_name">姓名</label>
                            <input type="text" value="{{ $query['recommend_name'] }}" name="recommend_name" id="recommend_name"
                                class="form-control" placeholder="陳龍">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="recommend_phone">電話</label>
                            <input type="number" value="{{ $query['recommend_phone'] }}" name="recommend_phone" id="recommend_phone"
                                class="form-control" placeholder="0910100100">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="recommend_relation">關係</label>
                            <input type="text" value="{{ $query['recommend_relation'] }}" name="recommend_relation"
                                id="recommend_relation" class="form-control" placeholder="前主管">
                        </div>

                        <div class="form-group col-md-2">
                            <label for="recommend_name_2">姓名</label>
                            <input type="text" value="{{ $query['recommend_name_2'] }}" name="recommend_name_2" id="recommend_name_2"
                                class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="recommend_phone_2">電話</label>
                            <input type="number" value="{{ $query['recommend_phone_2'] }}" name="recommend_phone_2" id="recommend_phone_2"
                                class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="recommend_relation_2">關係</label>
                            <input type="text" value="{{ $query['recommend_phone_2'] }}" name="recommend_relation_2"
                                id="recommend_relation_2" class="form-control" placeholder="">
                        </div>
                    </div>

                    <!-- 其他個人狀況 -->
                    <p class="h3">其他個人狀況</p>
                    <hr>
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="other_pregnancy">目前有無懷孕</label>
                            <select class="form-control form-select" name="other_pregnancy" id="other_pregnancy">
                                <option value="">請選擇</option>
                                <option value="1" @if ($query['other_pregnancy'] == 1) selected @endif>無</option>
                                <option value="2" @if ($query['other_pregnancy'] == 2) selected @endif>有</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="other_hospitalized">住院或開刀紀錄</label>
                            <select class="form-control form-select" name="other_hospitalized"
                                id="other_hospitalized">
                                <option value="">請選擇</option>
                                <option value="1" @if ($query['other_hospitalized'] == 1) selected @endif>無</option>
                                <option value="2" @if ($query['other_hospitalized'] == 2) selected @endif>有</option>
                            </select>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="other_hospitalizedReson">原因</label>
                            <input type="text" value="{{ $query['other_hospitalizedReson'] }}" name="other_hospitalizedReson"
                                id="other_hospitalizedReson" class="form-control" disabled="disabled">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="other_law">刑事或民事紀錄</label>
                            <select class="form-control form-select" name="other_law" id="other_law">
                                <option value="">請選擇</option>
                                <option value="1" @if ($query['other_law'] == 1) selected @endif>無</option>
                                <option value="2" @if ($query['other_law'] == 2) selected @endif>有</option>
                            </select>
                        </div>
                        <div class="form-group col-md-10">
                            <label for="other_lawReson">原因</label>
                            <input type="text" value="{{ $query['other_lawReson'] }}" name="other_lawReson" id="other_lawReson"
                                class="form-control" disabled="disabled">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="other_infoSource">求職資訊來源</label>
                            <select class="form-control form-select" name="other_infoSource"
                                id="other_infoSource">
                                <option value="">請選擇</option>
                                <option value="1" @if ($query['other_infoSource'] == 1) selected @endif>員工推薦</option>
                                <option value="2" @if ($query['other_infoSource'] == 2) selected @endif>其他來源</option>
                            </select>
                        </div>
                        <div class="form-group col-md-10">
                            <label for="other_infoSourceMemo">說明</label>
                            <input type="text" value="{{ $query['other_infoSourceMemo'] }}" name="other_infoSourceMemo"
                                id="other_infoSourceMemo" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="other_workOvertime">平日加班</label>
                            <select class="form-control form-select" name="other_workOvertime"
                                id="other_workOvertime">
                                <option value="">請選擇</option>
                                <option value="1" @if ($query['other_workOvertime'] == 1) selected @endif>可</option>
                                <option value="2" @if ($query['other_workOvertime'] == 2) selected @endif>否</option>
                            </select>
                        </div>
                        <div class="form-group col-md-10">
                            <label for="other_workOvertimeMemo">說明</label>
                            <input type="text" value="{{ $query['other_workOvertimeMemo'] }}" name="other_workOvertimeMemo"
                                id="other_workOvertimeMemo" class="form-control" disabled="disabled">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="other_workOvertimeHoliday">例假日加班</label>
                            <select class="form-control form-select" name="other_workOvertimeHoliday"
                                id="other_workOvertimeHoliday">
                                <option value="">請選擇</option>
                                <option value="1" @if ($query['other_workOvertimeHoliday'] == 1) selected @endif>可</option>
                                <option value="2" @if ($query['other_workOvertimeHoliday'] == 2) selected @endif>否</option>
                            </select>
                        </div>
                        <div class="form-group col-md-10">
                            <label for="other_workOvertimeHolidayMemo">說明</label>
                            <input type="text" value="{{ $query['other_workOvertimeHolidayMemo'] }}" name="other_workOvertimeHolidayMemo"
                                id="other_workOvertimeHolidayMemo" class="form-control" disabled="disabled">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="other_future">請說明您的生涯規劃</label>
                            <textarea class="form-control" name="other_future" id="other_future" rows="5" placeholder="">{{ $query['other_future'] }}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-check col-md-12 text-center">
                            {{-- <input class="form-check-input" type="checkbox" value=""
                                id="formCheck"> --}}
                            <label class="form-check-label" for="formCheck">
                                本人已確認本表所填寫各項均屬實，如有虛假願接受公司無條件解僱之處分與相關法律之責。
                            </label>
                        </div>
                    </div>
                    <!-- form-column end -->
                </div>

                <div class="col-sm-12 c-form-footer text-center">
                    <div class="btn-group btn-group-lg">
                        <button type="submit" id="data_save" class="btn btn-primary">儲存資料</button>
                    </div>
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
            //console.log("document loaded");
            check_info_sex(); // 性別連動
            check_info_disability(); // 身心障礙
            check_info_military(); // 兵役狀況
            check_other_hospitalized(); // 住院
            check_other_law(); // 法律
            check_other_workOvertime(); // 加班
            check_other_workOvertimeHoliday(); // 例假日加班
        });
        $(window).on("load", function() {
            // console.log("window loaded");
        });
        // event
        // 上傳頭像
        $('#info_user_photo').on('click', function() {
            $('#upload_user_photo').trigger('click');
        });
        // 性別連動
        $("#info_sex").on('change', function() {
            check_info_sex();
        });
        // 身心障礙
        $("#info_disability").on('change', function() {
            check_info_disability();
        });
        // 兵役狀況
        $("#info_military").on('change', function() {
            check_info_military();
        });
        // 住院
        $("#other_hospitalized").on('change', function() {
            check_other_hospitalized();
        });
        // 法律
        $("#other_law").on('change', function() {
            check_other_law();
        });
        // 加班
        $("#other_workOvertime").on('change', function() {
            check_other_workOvertime();
        });
        // 例假日加班
        $("#other_workOvertimeHoliday").on('change', function() {
            check_other_workOvertimeHoliday();
        });
        // function
        // 載入頭像
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#info_user_photo').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        // 檢查身心障礙
        function check_info_disability() {
            if ($("#info_disability").val() == 1) {
                $("#info_disabilityType").attr('disabled', false);
                $("#info_disabilityLevel").attr('disabled', false);
            } else {
                $("#info_disabilityType").attr('disabled', true);
                $("#info_disabilityLevel").attr('disabled', true);
            }
        }
        // 檢查男女
        function check_info_sex() {
            // 兵役 , 懷孕
            if ($("#info_sex").val() == 1) {
                $("#info_military").attr('disabled', false);
                $("#other_pregnancy").attr('disabled', true);
            } else {
                $("#info_military").attr('disabled', true);
                $("#info_militaryDate").attr('disabled', true);
                $("#info_militaryReason").attr('disabled', true);
                $("#other_pregnancy").attr('disabled', false);
            }
        }
        // 檢查兵役
        function check_info_military() {
            // 1 役畢 2 免役  3 待役
            if ($("#info_military").val() == 1) {
                $("#info_militaryDate").attr('disabled', false);
            } else {
                $("#info_militaryDate").attr('disabled', true);
            }
            if ($("#info_military").val() == 2) {
                $("#info_militaryReason").attr('disabled', false);
            } else {
                $("#info_militaryReason").attr('disabled', true);
            }
        }
        // 檢查住院
        function check_other_hospitalized() {
            if ($("#other_hospitalized").val() == 2) {
                $("#other_hospitalizedReson").attr('disabled', false);
            } else {
                $("#other_hospitalizedReson").attr('disabled', true);
            }
        }
        // 法律
        function check_other_law() {
            if ($("#other_law").val() == 2) {
                $("#other_lawReson").attr('disabled', false);
            } else {
                $("#other_lawReson").attr('disabled', true);
            }
        }
        // 加班
        function check_other_workOvertime() {
            if ($("#other_workOvertime").val() == 2) {
                $("#other_workOvertimeMemo").attr('disabled', false);
            } else {
                $("#other_workOvertimeMemo").attr('disabled', true);
            }
        }
        // 例假日加班
        function check_other_workOvertimeHoliday(){
            if ($("#other_workOvertimeHoliday").val() == 2) {
                $("#other_workOvertimeHolidayMemo").attr('disabled', false);
            } else {
                $("#other_workOvertimeHolidayMemo").attr('disabled', true);
            }
        }

    </script>

</body>

</html>
