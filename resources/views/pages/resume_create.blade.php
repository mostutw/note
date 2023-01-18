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
            <form role="form" action="{{ url('pages/resumes') }}" method="post">
                {{ csrf_field() }}
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
                            <img src="{{ asset('img/user-photo.png') }}" class="c-circle" id="userPhoto"
                                name="userPhoto">
                            {{-- <input type="file" id="uploadUserPhoto" name="information[userPhoto]" accept="image/*"
                                onchange="readURL(this);" style="display:none"> --}}
                        </div>
                        <div class="col-md-10">
                            <div class="form-group col-md-4">
                                <label for="interview[department]">應徵部門</label>
                                <input type="text" value="" name="interview[department]" class="form-control"
                                    placeholder="研發部">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="interview[jobTitle]">應徵職位</label>
                                <input type="text" value="" name="interview[jobTitle]" class="form-control"
                                    placeholder="專案經理">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="interview[workDate]">最快可上班日期</label>
                                <input type="date" value="" name="interview[workDate]" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="interview[salary]">期望待遇</label>
                                <input type="number" value="" name="interview[salary]" class="form-control"
                                    placeholder="60000">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="interview[lowSalary]">最低可接受月薪</label>
                                <input type="number" value="" name="interview[lowSalary]" class="form-control"
                                    placeholder="58000">
                            </div>
                        </div>
                    </div>
                    <!-- 個人基本資料 -->
                    <p class="h3">基本資料</p>
                    <hr>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="chineseName" class="required">中文姓名</label>
                            <input type="text" value="" name="information[chineseName]" class="form-control"
                                placeholder="陳米" required="true">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="englishName">英文姓名</label>
                            <input type="text" value="" name="information[englishName]" class="form-control"
                                placeholder="Mi Chen">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="information[sex]" class="select required">性別</label>
                            <select class="form-control form-select" name="information[sex]" id="informationSex"
                                required="true">
                                <option value="">請選擇</option>
                                <option value="1">男</option>
                                <option value="2">女</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="information[marry]">婚姻</label>
                            <select class="form-control form-select" name="information[marry]">
                                <option value="">請選擇</option>
                                <option value="1">單身</option>
                                <option value="2">已婚</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="information[id]">身份證字號</label>
                            <input type="text" value="" name="information[id]"
                                class="form-control text-uppercase" placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="information[birthday]">出生年月日</label>
                            <input type="date" value="" name="information[birthday]" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="information[birthplace]">出生地</label>
                            <input type="text" value="" name="information[birthplace]" class="form-control"
                                placeholder="臺灣省桃園縣">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="information[height]">身高(cm)</label>
                            <input type="number" value="" name="information[height]" class="form-control"
                                placeholder="180">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="information[weight]">體重(kg)</label>
                            <input type="number" value="" name="information[weight]" class="form-control"
                                placeholder="80">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="information[blood]">血型</label>
                            <select class="form-control form-select" name="information[blood]">
                                <option value="">請選擇</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                                <option value="O">O</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="information[colorPerception]">辨色力</label>
                            <select class="form-control form-select" name="information[colorPerception]">
                                <option value="">請選擇</option>
                                <option value="1">正常</option>
                                <option value="2">色盲</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="information[visionLeft]">視力(左)</label>
                            <input type="number" value="" name="information[visionLeft]" class="form-control"
                                placeholder="1.0">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="information[visionRight]">視力(右)</label>
                            <input type="number" value="" name="information[visionRight]"
                                class="form-control" placeholder="1.0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="information[disability]">身心障礙</label>
                            <select class="form-control form-select" name="information[disability]" id="disability">
                                <option value="">請選擇</option>
                                <option value="1">是</option>
                                <option value="2">否</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="information[disabilityType]">類別</label>
                            <input type="text" value="" id="disabilityType"
                                name="information[disabilityType]" class="form-control" placeholder="" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="information[disabilityLevel]">程度</label>
                            <input type="text" value="" id="disabilityLevel"
                                name="information[disabilityLevel]" class="form-control" placeholder="" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="information[military]">兵役狀況</label>
                            <select class="form-control form-select" name="information[military]" id="military"
                                disabled>
                                <option value="">請選擇</option>
                                <option value="1">役畢</option>
                                <option value="2">免役</option>
                                <option value="3">待役</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="information[militaryDate]">退伍日期</label>
                            <input type="date" value="" id="militaryDate" name="information[militaryDate]"
                                class="form-control" disabled>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="information[militaryReason]">免役原因</label>
                            <input type="text" value="" id="militaryReason"
                                name="information[militaryReason]" class="form-control" placeholder="" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label for="information[email]">郵件信箱</label>
                            <input type="email" value="" name="information[email]" class="form-control"
                                placeholder="EMail">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="information[phone]" class="required">手機號碼</label>
                            <input type="number" value="" name="information[phone]" class="form-control"
                                placeholder="0900123456" required="true">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label for="information[address]">戶籍地址</label>
                            <input type="text" value="" name="information[address]" class="form-control"
                                placeholder="桃園市桃園區中正路1071號">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="information[tel]">戶籍電話</label>
                            <input type="number" value="" name="information[tel]" class="form-control"
                                placeholder="033587899">
                        </div>
                        <div class="form-group col-md-8">
                            <label for="information[address2]">通訊地址</label>
                            <input type="text" value="" name="information[address2]" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="information[tel2]">通訊電話</label>
                            <input type="number" value="" name="information[tel2]" class="form-control"
                                placeholder="">
                        </div>
                    </div>
                    <!-- 教育背景及專業課程 -->
                    <p class="h3">教育背景</p>
                    <hr>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="education[0][schoolLevel]" class="required">最高學歷</label>
                            <select class="form-control form-select" name="education[0][schoolLevel]"
                                id="education0schoolLevel" required="true">
                                <option value="">請選擇</option>
                                <option value="1">博士</option>
                                <option value="2">碩士</option>
                                <option value="3">大學</option>
                                <option value="4">四技</option>
                                <option value="5">二技</option>
                                <option value="6">二專</option>
                                <option value="7">三專</option>
                                <option value="8">五專</option>
                                <option value="9">高中</option>
                                <option value="10">高職</option>
                                <option value="11">國中</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="education[0][schoolName]" class="required">學校名稱</label>
                            <input type="text" value="" name="education[0][schoolName]"
                                class="form-control" placeholder="" required="true">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="education[0][schoolDepartment]" class="required">科系名稱</label>
                            <input type="text" value="" name="education[0][schoolDepartment]"
                                class="form-control" placeholder="" required="true">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="education[0][schoolStatus]" class="required">就學狀態</label>
                            <select class="form-control form-select" name="education[0][schoolStatus]"
                                required="true">
                                <option value="">請選擇</option>
                                <option value="1">畢業</option>
                                <option value="2">肄業</option>
                                <option value="3">就學中</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="education[0][schoolStartDate]" class="required">就學期間</label>
                            <input type="month" value="" name="education[0][schoolStartDate]"
                                class="form-control" required="true">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="education[0][schoolEndDate]">&nbsp;</label>
                            <input type="month" value="" name="education[0][schoolEndDate]"
                                class="form-control" required="true">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="education[0][schoolThesisTopic]">論文題目</label>
                            <input type="text" value="" name="education[0][schoolThesisTopic]"
                                id="education0schoolThesisTopic" class="form-control" placeholder="" disabled>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="education[1][schoolLevel]">次高學歷</label>
                            <select class="form-control form-select" name="education[1][schoolLevel]"
                                id="education1schoolLevel">
                                <option value="">請選擇</option>
                                <option value="1">博士</option>
                                <option value="2">碩士</option>
                                <option value="3">大學</option>
                                <option value="4">四技</option>
                                <option value="5">二技</option>
                                <option value="6">二專</option>
                                <option value="7">三專</option>
                                <option value="8">五專</option>
                                <option value="9">高中</option>
                                <option value="10">高職</option>
                                <option value="11">國中</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="education[1][schoolName]">學校名稱</label>
                            <input type="text" value="" name="education[1][schoolName]"
                                class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="education[1][schoolDepartment]">科系名稱</label>
                            <input type="text" value="" name="education[1][schoolDepartment]"
                                class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="education[1][schoolStatus]">就學狀態</label>
                            <select class="form-control form-select" name="education[1][schoolStatus]">
                                <option value="">請選擇</option>
                                <option value="1">畢業</option>
                                <option value="2">肄業</option>
                                <option value="3">就學中</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="education[1][schoolStartDate]">就學期間</label>
                            <input type="month" value="" name="education[1][schoolStartDate]"
                                class="form-control">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="education[1][schoolEndDate]">&nbsp;</label>
                            <input type="month" value="" name="education[1][schoolEndDate]"
                                class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="education[0][schoolThesisTopic]">論文題目</label>
                            <input type="text" value="" name="education[1][schoolThesisTopic]"
                                id="education1schoolThesisTopic" class="form-control" placeholder="" disabled>
                        </div>
                    </div>
                    <br>

                    <!-- 工作經歷 -->
                    <p class="h3">工作經歷</p>
                    <hr>
                    <!-- 工作一 -->
                    <div class="row ex0">
                        <div class="form-group col-md-4">
                            <label for="exp[0][companyName]">公司名稱</label>
                            <input type="text" value="" name="exp[0][companyName]" class="form-control"
                                placeholder="大豐科技">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[0][companyDepartment]">部門</label>
                            <input type="text" value="" name="exp[0][companyDepartment]"
                                class="form-control" placeholder="資訊部">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[0][jobTitle]">職稱</label>
                            <input type="text" value="" name="exp[0][jobTitle]" class="form-control"
                                placeholder="工程師">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[0][workPlace]">工作地點</label>
                            <input type="text" value="" name="exp[0][workPlace]" class="form-control"
                                placeholder="台北">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[0][startDate]">任職期間</label>
                            <input type="month" value="" name="exp[0][startDate]" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[0][endDate]">&nbsp;</label>
                            <input type="month" value="" name="exp[0][endDate]" class="form-control">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="exp[0][content]">工作描述</label>
                            <textarea class="form-control" name="exp[0][content]" rows="6" placeholder="描述工作內容..."></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exp[0][leaveReson]">離職原因</label>
                            <input type="text" value="" name="exp[0][leaveReson]" class="form-control"
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
                            <input type="text" value="" name="exp[1][companyName]" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[1][companyDepartment]">部門</label>
                            <input type="text" value="" name="exp[1][companyDepartment]"
                                class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[1][jobTitle]">職稱</label>
                            <input type="text" value="" name="exp[1][jobTitle]" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[1][workPlace]">工作地點</label>
                            <input type="text" value="" name="exp[1][workPlace]" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[1][startDate]">任職期間</label>
                            <input type="month" value="" name="exp[1][startDate]" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[1][endDate]">&nbsp;</label>
                            <input type="month" value="" name="exp[1][endDate]" class="form-control">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="exp[1][content]">工作描述</label>
                            <textarea class="form-control" name="exp[1][content]" rows="6" placeholder="描述工作內容..."></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exp[1][leaveReson]">離職原因</label>
                            <input type="text" value="" name="exp[1][leaveReson]" class="form-control"
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
                            <input type="text" value="" name="exp[2][companyName]" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[2][companyDepartment]">部門</label>
                            <input type="text" value="" name="exp[2][companyDepartment]"
                                class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[2][jobTitle]">職稱</label>
                            <input type="text" value="" name="exp[2][jobTitle]" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[2][workPlace]">工作地點</label>
                            <input type="text" value="" name="exp[2][workPlace]" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[2][startDate]">任職期間</label>
                            <input type="month" value="" name="exp[2][startDate]" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[2][endDate]">&nbsp;</label>
                            <input type="month" value="" name="exp[2][endDate]" class="form-control">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="exp[2][content]">工作描述</label>
                            <textarea class="form-control" name="exp[2][content]" rows="6" placeholder="描述工作內容..."></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exp[2][leaveReson]">離職原因</label>
                            <input type="text" value="" name="exp[2][leaveReson]" class="form-control"
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
                            <input type="text" value="" name="exp[3][companyName]" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[3][companyDepartment]">部門</label>
                            <input type="text" value="" name="exp[3][companyDepartment]"
                                class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[3][jobTitle]">職稱</label>
                            <input type="text" value="" name="exp[3][jobTitle]" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[3][workPlace]">工作地點</label>
                            <input type="text" value="" name="exp[3][workPlace]" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[3][startDate]">任職期間</label>
                            <input type="month" value="" name="exp[3][startDate]" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[3][endDate]">&nbsp;</label>
                            <input type="month" value="" name="exp[3][endDate]" class="form-control">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="exp[3][content]">工作描述</label>
                            <textarea class="form-control" name="exp[3][content]" rows="6" placeholder="描述工作內容..."></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exp[3][leaveReson]">離職原因</label>
                            <input type="text" value="" name="exp[3][leaveReson]" class="form-control"
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
                            <input type="text" value="" name="exp[4][companyName]" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[4][companyDepartment]">部門</label>
                            <input type="text" value="" name="exp[4][companyDepartment]"
                                class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[4][jobTitle]">職稱</label>
                            <input type="text" value="" name="exp[4][jobTitle]" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[4][workPlace]">工作地點</label>
                            <input type="text" value="" name="exp[4][workPlace]" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[4][startDate]">任職期間</label>
                            <input type="month" value="" name="exp[4][startDate]" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exp[4][endDate]">&nbsp;</label>
                            <input type="month" value="" name="exp[4][endDate]" class="form-control">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="exp[4][content]">工作描述</label>
                            <textarea class="form-control" name="exp[4][content]" rows="6" placeholder="描述工作內容..."></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exp[4][leaveReson]">離職原因</label>
                            <input type="text" value="" name="exp[4][leaveReson]" class="form-control"
                                placeholder="">
                        </div>
                    </div>
                    <br>
                    {{-- <button type="button" class="btn btn-primary" id="addEx">新增工作經歷</button> --}}
                    <!-- 個人特質/專業能力 -->
                    <p class="h3">專業能力</p>
                    <hr>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="professionalStrength">個人優點</label>
                            <input type="text" value="" name="professional[strength]" class="form-control"
                                id="professionalStrength" placeholder="大膽細心">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="professionalWeakness">個人缺點</label>
                            <input type="text" value="" name="professional[weakness]" class="form-control"
                                id="professionalWeakness" placeholder="過於固執">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="professionalLangEnLevel">英文</label>
                            <select class="form-control form-select" name="professional[langEnLevel]"
                                id="professionalLangEnLevel">
                                <option value="">請選擇</option>
                                <option value="1">精通</option>
                                <option value="2">中等</option>
                                <option value="3">略懂</option>
                                <option value="4">不懂</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="professionalLangTwLevel">台語</label>
                            <select class="form-control form-select" name="professional[langTwLevel]"
                                id="professionalLangTwLevel">
                                <option value="">請選擇</option>
                                <option value="1">精通</option>
                                <option value="2">中等</option>
                                <option value="3">略懂</option>
                                <option value="4">不懂</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="professionalLicense">專業證照</label>
                        <textarea class="form-control" name="professional[license]" id="professionalLicense" rows="3"
                            placeholder="Microsoft MVP, Google Cloud Digital Leader"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="professionalSkill">專業技能</label>
                        <textarea class="form-control" name="professional[skill]" id="professionalSkill" rows="3"
                            placeholder="C#, ASP.NET, MSSQL, Git"></textarea>
                    </div>

                    <!-- 家庭狀況 -->
                    <p class="h3">家庭狀況</p>
                    <hr>

                    <!-- 第1位 -->
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="family0title">稱謂</label>
                            <input type="text" value="" name="family[0][title]" class="form-control"
                                id="family0title" placeholder="父">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family0name">姓名</label>
                            <input type="text" value="" name="family[0][name]" class="form-control"
                                id="family0name" placeholder="陳大米">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family0age">年齡</label>
                            <input type="number" value="" name="family[0][age]" class="form-control"
                                id="family0age" placeholder="70">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family0job">職業</label>
                            <input type="text" value="" name="family[0][job]" class="form-control"
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
                            <input type="text" value="" name="family[1][title]" class="form-control"
                                id="family1title" placeholder="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family1name">姓名</label>
                            <input type="text" value="" name="family[1][name]" class="form-control"
                                id="family1name" placeholder="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family1age">年齡</label>
                            <input type="number" value="" name="family[1][age]" class="form-control"
                                id="family1age" placeholder="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family1job">職業</label>
                            <input type="text" value="" name="family[1][job]" class="form-control"
                                id="family1job" placeholder="">
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
                            <input type="text" value="" name="family[2][title]" class="form-control"
                                id="family2title" placeholder="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family2name">姓名</label>
                            <input type="text" value="" name="family[2][name]" class="form-control"
                                id="family2name" placeholder="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family2age">年齡</label>
                            <input type="number" value="" name="family[2][age]" class="form-control"
                                id="family2age" placeholder="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family2job">職業</label>
                            <input type="text" value="" name="family[2][job]" class="form-control"
                                id="family2job" placeholder="">
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
                            <input type="text" value="" name="family[3][title]" class="form-control"
                                id="family3title" placeholder="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family3name">姓名</label>
                            <input type="text" value="" name="family[3][name]" class="form-control"
                                id="family3name" placeholder="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family3age">年齡</label>
                            <input type="number" value="" name="family[3][age]" class="form-control"
                                id="family3age" placeholder="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family3job">職業</label>
                            <input type="text" value="" name="family[3][job]" class="form-control"
                                id="family3job" placeholder="">
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
                            <input type="text" value="" name="family[4][title]" class="form-control"
                                id="family4title" placeholder="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family4name">姓名</label>
                            <input type="text" value="" name="family[4][name]" class="form-control"
                                id="family4name" placeholder="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family4age">年齡</label>
                            <input type="number" value="" name="family[4][age]" class="form-control"
                                id="family4age" placeholder="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family4job">職業</label>
                            <input type="text" value="" name="family[4][job]" class="form-control"
                                id="family4job" placeholder="">
                        </div>
                    </div>
                    <!-- 緊急聯絡 -->
                    <div class="row">
                        <hr>
                        <div class="form-group col-md-2">
                            <label for="familyEmergencyContactName">緊急聯絡人</label>
                            <input type="text" value="" name="family[emergencyContactName]"
                                id="familyEmergencyContactName" class="form-control" placeholder="黃大城">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="familyEmergencyContactPhone">電話</label>
                            <input type="number" value="" name="family[emergencyContactPhone]"
                                id="familyEmergencyContactPhone" class="form-control" placeholder="0982888999">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="familyEmergencyContactRelation">關係</label>
                            <input type="text" value="" name="family[emergencyContactRelation]"
                                id="familyEmergencyContactRelation" class="form-control" placeholder="">
                        </div>
                    </div>
                    <!-- 推薦人 -->
                    <p class="h3">推薦人</p>
                    <hr>
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="recommend0name">姓名</label>
                            <input type="text" value="" name="recommend[0][name]" class="form-control"
                                id="recommend0name" placeholder="陳龍">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="recommend0phone">電話</label>
                            <input type="number" value="" name="recommend[0][phone]" class="form-control"
                                id="recommend0phone" placeholder="0910100100">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="recommend0relation">關係</label>
                            <input type="text" value="" name="recommend[0][relation]" class="form-control"
                                id="recommend0relation" placeholder="前主管">
                        </div>

                        <div class="form-group col-md-2">
                            <label for="recommend1name">姓名</label>
                            <input type="text" value="" name="recommend[1][name]" class="form-control"
                                id="recommend1name" placeholder="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="recommend1phone">電話</label>
                            <input type="number" value="" name="recommend[1][phone]" class="form-control"
                                id="recommend1phone" placeholder="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="recommend1relation">關係</label>
                            <input type="text" value="" name="recommend[1][relation]"
                                class="form-control" id="recommend1relation" placeholder="">
                        </div>
                    </div>

                    <!-- 其他個人狀況 -->
                    <p class="h3">其他個人狀況</p>
                    <hr>
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="otherPregnancy">目前有無懷孕</label>
                            <select class="form-control form-select" name="other[pregnancy]" id="otherPregnancy">
                                <option value="">請選擇</option>
                                <option value="1">無</option>
                                <option value="2">有</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="otherHospitalized">有無住院或開刀紀錄</label>
                            <select class="form-control form-select" name="other[hospitalized]"
                                id="otherHospitalized">
                                <option value="">請選擇</option>
                                <option value="1">無</option>
                                <option value="2">有</option>
                            </select>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="otherHospitalizedReson">原因</label>
                            <input type="text" value="" name="other[hospitalizedReson]"
                                id="otherHospitalizedReson" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="otherLaw">刑事或民事紀錄</label>
                            <select class="form-control form-select" name="other[law]" id="otherLaw">
                                <option value="">請選擇</option>
                                <option value="1">無</option>
                                <option value="2">有</option>
                            </select>
                        </div>
                        <div class="form-group col-md-10">
                            <label for="otherLawReson">原因</label>
                            <input type="text" value="" name="other[lawReson]" class="form-control"
                                id="otherLawReson" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="otherJobSource">求職資訊來源</label>
                            <select class="form-control form-select" name="other[jobSource]" id="otherJobSource">
                                <option value="">請選擇</option>
                                <option value="1">員工推薦</option>
                                <option value="2">其他</option>
                            </select>
                        </div>
                        <div class="form-group col-md-10">
                            <label for="otherJobSourceMeno">說明</label>
                            <input type="text" value="" name="other[jobSourceMeno]"
                                class="form-control" id="otherJobSourceMeno" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="otherOvertime">平日加班</label>
                            <select class="form-control form-select" name="other[overtime]" id="otherOvertime">
                                <option value="">請選擇</option>
                                <option value="1">可</option>
                                <option value="2">否</option>
                            </select>
                        </div>
                        <div class="form-group col-md-10">
                            <label for="otherOvertimeMeno">說明</label>
                            <input type="text" value="" name="other[overtimeMeno]" class="form-control"
                                id="otherOvertimeMeno" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="otherHolidayOvertime">例假日加班</label>
                            <select class="form-control form-select" name="other[holidayOvertime]"
                                id="otherHolidayOvertime">
                                <option value="">請選擇</option>
                                <option value="1">可</option>
                                <option value="2">否</option>
                            </select>
                        </div>
                        <div class="form-group col-md-10">
                            <label for="otherHolidayOvertimeMemo">說明</label>
                            <input type="text" value="" name="other[holidayOvertimeMemo]"
                                class="form-control" id="otherHolidayOvertimeMemo" disabled>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="otherFuture">請說明您的生涯規劃</label>
                            <textarea class="form-control" name="other[future]" id="otherFuture" rows="5" placeholder=""></textarea>
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
                        <button type="submit" id="dataSave" class="btn btn-primary">儲存資料</button>
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
        // 上傳頭像
        $('#userPhoto').on('click', function() {
            $('#uploadUserPhoto').trigger('click');
        });
        // 重新載入頭像
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#userPhoto').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        // 身心障礙
        $("#disability").on('change', function() {
            // 1 是 2 否
            if ($(this).val() == 1) {
                $("#disabilityType").removeAttr('disabled');
                $("#disabilityLevel").removeAttr('disabled');
            } else {
                $("#disabilityType").attr('disabled', 'disabled');
                $("#disabilityLevel").attr('disabled', 'disabled');
            }
        });
        // 判斷男女後再確認兵役狀況
        $("#informationSex").on('change', function() {
            if ($(this).val() == 1) {
                $("#military").removeAttr('disabled');
            } else {
                $("#military").attr('disabled', 'disabled');
                $("#militaryDate").attr('disabled', 'disabled');
                $("#militaryReason").attr('disabled', 'disabled');
            }
        });
        // 兵役狀況
        $("#military").on('change', function() {
            // 1 役畢 2 免役  3 待役
            if ($(this).val() == 1) {
                $("#militaryDate").removeAttr('disabled');
            } else {
                $("#militaryDate").attr('disabled', 'disabled');
            }
            if ($(this).val() == 2) {
                $("#militaryReason").removeAttr('disabled');
            } else {
                $("#militaryReason").attr('disabled', 'disabled');
            }
        });
        // 最高學歷
        $("#education0schoolLevel").on('change', function() {
            if ($(this).val() == 1 || $(this).val() == 2) {
                $("#education0schoolThesisTopic").removeAttr('disabled');
            } else {
                $("#education0schoolThesisTopic").attr('disabled', 'disabled');
            }
        });
        // 次高學歷
        $("#education1schoolLevel").on('change', function() {
            if ($(this).val() == 1 || $(this).val() == 2) {
                $("#education1schoolThesisTopic").removeAttr('disabled');
            } else {
                $("#education1schoolThesisTopic").attr('disabled', 'disabled');
            }
        });
        
    </script>

</body>

</html>
