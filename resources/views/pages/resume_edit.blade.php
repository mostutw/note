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
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('fail'))
                    <div class="alert alert-success">
                        {{ session('fail') }}
                    </div>
                @endif
                <div>
                    {{-- <img src="{{ asset('img/logo_icon.png') }}" class="c-img-banner" alt=""> --}}
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
                            <input type="file" id="upload_user_photo" name="upload_user_photo" accept="image/*"
                                onchange="readURL(this);" style="display:none">
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
                                    placeholder="工程師">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="interview_workDate">最快可上班日期</label>
                                <input type="date" value="{{ $query['interview_workDate'] }}"
                                    name="interview_workDate" id="interview_workDate" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="interview_salary">期望待遇</label>
                                <input type="number" value="{{ $query['interview_salary'] }}" name="interview_salary"
                                    id="interview_salary" class="form-control" placeholder="50000">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="interview_lowSalary">最低可接受月薪</label>
                                <input type="number" value="{{ $query['interview_lowSalary'] }}"
                                    name="interview_lowSalary" id="interview_lowSalary" class="form-control"
                                    placeholder="48000">
                            </div>
                        </div>
                    </div>
                    <!-- 個人基本資料 -->

                    <p class="h3 c-title">基本資料</p>
                    <hr class="hr1">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="info_chineseName" class="required">中文姓名</label>
                            <input type="text" value="{{ $query['info_chineseName'] }}" name="info_chineseName"
                                id="info_chineseName" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="info_englishName">英文姓名</label>
                            <input type="text" value="{{ $query['info_englishName'] }}" name="info_englishName"
                                id="info_englishName" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="info_sex" class="select required">性別</label>
                            <select class="form-control form-select" name="info_sex" id="info_sex" required>
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
                                id="info_birthplace" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="info_height">身高(cm)</label>
                            <input type="number" value="{{ $query['info_height'] }}" name="info_height"
                                id="info_height" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="info_weight">體重(kg)</label>
                            <input type="number" value="{{ $query['info_weight'] }}" name="info_weight"
                                id="info_weight" class=" form-control" placeholder="">
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
                            <input type="number" step="0.1" value="{{ $query['info_visionLeft'] }}"
                                name="info_visionLeft" id="info_visionLeft" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="info_visionRight">視力(右)</label>
                            <input type="number" value="{{ $query['info_visionRight'] }}" name="info_visionRight"
                                id="info_visionRight" class="form-control" placeholder="">
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
                            <label for="info_phone" class="">手機號碼</label>
                            <input type="number" value="{{ $query['info_phone'] }}" name="info_phone"
                                id="info_phone" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label for="info_address">戶籍地址</label>
                            <input type="text" value="{{ $query['info_address'] }}" name="info_address"
                                id="info_address" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="info_telephone">戶籍電話</label>
                            <input type="number" value="{{ $query['info_telephone'] }}" name="info_telephone"
                                id="info_telephone" class="form-control" placeholder="">
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
                    <!-- 教育背景/專業課程 -->

                    <p class="h3 c-title">教育背景/專業課程(請由最高、次高…依序填寫)</p>
                    <hr class="hr1">
                    @for ($i = 0; $i < 3; $i++)
                        <div class="row">
                            <div class="form-group col-md-2">
                                <input type="hidden" name="education[{{ $i }}][id]"
                                    value="{{ isset($education[$i]['id']) ? $education[$i]['id'] : '' }}">
                                <label for="education[{{ $i }}][schoolLevel]"
                                    @if ($i == 0) class="required" @endif>學歷</label>
                                <select class="form-control form-select"
                                    name="education[{{ $i }}][school_level]"
                                    @if ($i == 0) required @endif>
                                    {{-- <option value="">請選擇</option> --}}
                                    @foreach ($select_list['school_level'] as $key => $value)
                                        @if (isset($education[$i]))
                                            @if ($education[$i]['school_level'] == $key)
                                                <option value="{{ $key }}" selected>{{ $value }}
                                                </option>
                                            @else
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endif
                                        @else
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="education[{{ $i }}][schoolName]"
                                    @if ($i == 0) class="required" @endif>學校名稱</label>
                                <input type="text"
                                    value="{{ isset($education[$i]['school_name']) ? $education[$i]['school_name'] : '' }}"
                                    name="education[{{ $i }}][school_name]" class="form-control"
                                    placeholder="" @if ($i == 0) required @endif>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="education[{{ $i }}][schoolDepartment]"
                                    @if ($i == 0) class="required" @endif>科系名稱</label>
                                <input type="text"
                                    value="{{ isset($education[$i]['school_department']) ? $education[$i]['school_department'] : '' }}"
                                    name="education[{{ $i }}][school_department]" class="form-control"
                                    placeholder="" @if ($i == 0) required @endif>
                            </div>

                            <div class="form-group col-md-2">
                                <label for="education[{{ $i }}][schoolStatus]"
                                    @if ($i == 0) class="required" @endif>就學狀態</label>
                                <select class="form-control form-select"
                                    name="education[{{ $i }}][school_status]"
                                    @if ($i == 0) required @endif>
                                    <option value="">請選擇</option>
                                    @foreach ($select_list['school_status'] as $key => $value)
                                        @if (isset($education[$i]))
                                            @if ($education[$i]['school_status'] == $key)
                                                <option value="{{ $key }}" selected>{{ $value }}
                                                </option>
                                            @else
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endif
                                        @else
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="education[0][schoolStartDate]"
                                    @if ($i == 0) class="required" @endif>起訖時間</label>
                                <input type="month"
                                    value="{{ isset($education[$i]['school_startDate']) ? $education[$i]['school_startDate']->format('Y-m') : '' }}"
                                    name="education[{{ $i }}][school_startDate]" class="form-control"
                                    @if ($i == 0) required @endif>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="education[0][schoolEndDate]">&nbsp;</label>
                                <input type="month"
                                    value="{{ isset($education[$i]['school_endDate']) ? $education[$i]['school_endDate']->format('Y-m') : '' }}"
                                    name="education[{{ $i }}][school_endDate]" class="form-control">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="education[{{ $i }}][schoolThesisTopic]">畢業論文題目</label>
                                <input type="text"
                                    value="{{ isset($education[$i]['school_thesisTopic']) ? $education[$i]['school_thesisTopic'] : '' }}"
                                    name="education[{{ $i }}][school_thesisTopic]" class="form-control"
                                    placeholder="">
                            </div>
                        </div>
                    @endfor
                    <div class="row">
                        <div class="form-group col-md-3">
                            <input type="hidden" name="course[0][id]"
                                value="{{ isset($course[0]['id']) ? $course[0]['id'] : '' }}">
                            <label for="course[0][courseName]" class="">專業課程名稱</label>
                            <input type="text"
                                value="{{ isset($course[0]['course_name']) ? $course[0]['course_name'] : '' }}"
                                name="course[0][course_name]" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="course[0][courseDepartment]" class="">受訓單位</label>
                            <input type="text"
                                value="{{ isset($course[0]['course_department']) ? $course[0]['course_department'] : '' }}"
                                name="course[0][course_department]" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="course[0][courseStartDate]" class="">起訖時間</label>
                            <input type="month"
                                value="{{ isset($course[0]['course_startDate']) ? $course[0]['course_startDate']->format('Y-m') : '' }}"
                                name="course[0][course_startDate]" class="form-control">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="course[0][courseEndDate]">&nbsp;</label>
                            <input type="month"
                                value="{{ isset($course[0]['course_endDate']) ? $course[0]['course_endDate']->format('Y-m') : '' }}"
                                name="course[0][course_endDate]" class="form-control">
                        </div>
                    </div>
                    <!-- 工作經歷 -->

                    <p class="h3 c-title">工作經歷(請由最近一份工作依序填寫)</p>
                    <hr class="hr3">

                    @for ($i = 0; $i < 6; $i++)
                        {{-- @if ($i > 1)
                            <button class="btn btn-primary" type="button" data-toggle="collapse"
                                data-target="#collapseEx{{ $i }}" aria-expanded="false"
                                aria-controls="collapseEx{{ $i }}">+</button>
                            <div class="row collapse" id="collapseEx{{ $i }}">
                            @else --}}
                        <div class="row">
                            {{-- @endif --}}
                            <br>
                            <input type="hidden" name="exp[{{ $i }}][id]"
                                value="{{ isset($exp[$i]['id']) ? $exp[$i]['id'] : '' }}">
                            <div class="form-group col-md-3">
                                <label for="exp_companyName">公司名稱</label>
                                <input type="text" name="exp[{{ $i }}][exp_companyName]"
                                    value="{{ isset($exp[$i]['exp_companyName']) ? $exp[$i]['exp_companyName'] : '' }}"
                                    class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="exp_companyDepartment">部門</label>
                                <input type="text" name="exp[{{ $i }}][exp_companyDepartment]"
                                    value="{{ isset($exp[$i]['exp_companyDepartment']) ? $exp[$i]['exp_companyDepartment'] : '' }}"
                                    class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="exp_jobTitle">職稱</label>
                                <input type="text" name="exp[{{ $i }}][exp_jobTitle]"
                                    value="{{ isset($exp[$i]['exp_jobTitle']) ? $exp[$i]['exp_jobTitle'] : '' }}"
                                    class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="exp_workPlace">工作地點</label>
                                <input type="text" name="exp[{{ $i }}][exp_workPlace]"
                                    value="{{ isset($exp[$i]['exp_workPlace']) ? $exp[$i]['exp_workPlace'] : '' }}"
                                    class="form-control" placeholder="">
                            </div>

                            <div class="form-group col-md-2">
                                <label for="exp_startDate">任職期間</label>
                                <input type="month" name="exp[{{ $i }}][exp_startDate]"
                                    value="{{ isset($exp[$i]['exp_startDate']) ? $exp[$i]['exp_startDate']->format('Y-m') : '' }}"
                                    class="form-control">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="exp_endDate">&nbsp;</label>
                                <input type="month" name="exp[{{ $i }}][exp_endDate]"
                                    value="{{ isset($exp[$i]['exp_endDate']) ? $exp[$i]['exp_endDate']->format('Y-m') : '' }}"
                                    class="form-control">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="exp_leaveReason">離職原因</label>
                                <input type="text" name="exp[{{ $i }}][exp_leaveReason]"
                                    value="{{ isset($exp[$i]['exp_leaveReason']) ? $exp[$i]['exp_leaveReason'] : '' }}"
                                    class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="exp_salary">薪資(月薪)</label>
                                <input type="number" name="exp[{{ $i }}][exp_salary]"
                                    value="{{ isset($exp[$i]['exp_salary']) ? $exp[$i]['exp_salary'] : '' }}"
                                    class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-11">
                                <label for="exp_content">工作描述</label>
                                <textarea class="form-control" name="exp[{{ $i }}][exp_content]" rows="6" placeholder="描述工作內容...">{{ isset($exp[$i]['exp_content']) ? $exp[$i]['exp_content'] : '' }}</textarea>
                            </div>
                        </div>
                        <hr class="hr3">
                    @endfor
                    <!-- 個人特質/專業能力 -->

                    <p class="h3 c-title">個人特質/專業能力</p>
                    <hr class="hr4">
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="feature_strength">優點</label>
                            <input type="text" value="{{ $query['feature_strength'] }}" name="feature_strength"
                                id="feature_strength" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="feature_weakness">缺點</label>
                            <input type="text" value="{{ $query['feature_weakness'] }}" name="feature_weakness"
                                id="feature_weakness" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2">
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
                        <div class="form-group col-md-2">
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
                    <div class="row">
                        <div class="form-group col-md-10">
                            <label for="feature_license">證照</label>
                            <textarea class="form-control" name="feature_license" id="feature_license" rows="3"
                                placeholder="AWS 架構師-助理認證">{{ $query['feature_license'] }}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-10">
                            <label for="feature_skill">專業技能</label>
                            <textarea class="form-control" name="feature_skill" id="feature_skill" rows="3" placeholder="C#, MSSQL, Git">{{ $query['feature_skill'] }}</textarea>
                        </div>
                    </div>
                    <!-- 家庭狀況 -->

                    <p class="h3 c-title">家庭狀況</p>
                    <hr class="hr4">

                    @for ($i = 0; $i < 6; $i++)
                        <div class="row">
                            <input type="hidden" name="family[{{ $i }}][id]"
                                value="{{ isset($family[$i]['id']) ? $family[$i]['id'] : '' }}">
                            <div class="form-group col-md-2">
                                <label for="family_title">關係</label>
                                <input type="text"
                                    value="{{ isset($family[$i]['family_title']) ? $family[$i]['family_title'] : '' }}"
                                    name="family[{{ $i }}][family_title]" class="form-control"
                                    placeholder="">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="family_name">姓名</label>
                                <input type="text"
                                    value="{{ isset($family[$i]['family_name']) ? $family[$i]['family_name'] : '' }}"
                                    name="family[{{ $i }}][family_name]" class="form-control"
                                    placeholder="">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="family_age">年齡</label>
                                <input type="number"
                                    value="{{ isset($family[$i]['family_age']) ? $family[$i]['family_age'] : '' }}"
                                    name="family[{{ $i }}][family_age]" class="form-control"
                                    placeholder="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="family_job">職業</label>
                                <input type="text"
                                    value="{{ isset($family[$i]['family_job']) ? $family[$i]['family_job'] : '' }}"
                                    name="family[{{ $i }}][family_job]" class="form-control"
                                    placeholder="">
                            </div>
                        </div>
                    @endfor

                    <!-- 緊急聯絡 -->
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="family_emergencyContactName">緊急聯絡人</label>
                            <input type="text" value="{{ $query['family_emergencyContactName'] }}"
                                name="family_emergencyContactName" id="family_emergencyContactName"
                                class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family_emergencyContactPhone">電話</label>
                            <input type="number" value="{{ $query['family_emergencyContactPhone'] }}"
                                name="family_emergencyContactPhone" id="family_emergencyContactPhone"
                                class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="family_emergencyContactRelation">關係</label>
                            <input type="text" value="{{ $query['family_emergencyContactRelation'] }}"
                                name="family_emergencyContactRelation" id="family_emergencyContactRelation"
                                class="form-control" placeholder="">
                        </div>
                    </div>
                    <!-- 推薦人 -->

                    <p class="h3 c-title">推薦人</p>
                    <hr class="hr4">
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="recommend_name">姓名</label>
                            <input type="text" value="{{ $query['recommend_name'] }}" name="recommend_name"
                                id="recommend_name" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="recommend_phone">電話</label>
                            <input type="number" value="{{ $query['recommend_phone'] }}" name="recommend_phone"
                                id="recommend_phone" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="recommend_relation">關係</label>
                            <input type="text" value="{{ $query['recommend_relation'] }}"
                                name="recommend_relation" id="recommend_relation" class="form-control"
                                placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="recommend_name_2">姓名</label>
                            <input type="text" value="{{ $query['recommend_name_2'] }}" name="recommend_name_2"
                                id="recommend_name_2" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="recommend_phone_2">電話</label>
                            <input type="number" value="{{ $query['recommend_phone_2'] }}"
                                name="recommend_phone_2" id="recommend_phone_2" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="recommend_relation_2">關係</label>
                            <input type="text" value="{{ $query['recommend_relation_2'] }}"
                                name="recommend_relation_2" id="recommend_relation_2" class="form-control"
                                placeholder="">
                        </div>
                    </div>

                    <!-- 其他個人狀況 -->

                    <p class="h3 c-title">其他個人狀況</p>
                    <hr class="hr4">
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
                        <div class="form-group col-md-6">
                            <label for="other_hospitalizedReason">原因</label>
                            <input type="text" value="{{ $query['other_hospitalizedReason'] }}"
                                name="other_hospitalizedReason" id="other_hospitalizedReason" class="form-control"
                                disabled="disabled">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="other_law">刑事/民事紀錄</label>
                            <select class="form-control form-select" name="other_law" id="other_law">
                                <option value="">請選擇</option>
                                <option value="1" @if ($query['other_law'] == 1) selected @endif>無</option>
                                <option value="2" @if ($query['other_law'] == 2) selected @endif>有</option>
                            </select>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="other_lawReason">原因</label>
                            <input type="text" value="{{ $query['other_lawReason'] }}" name="other_lawReason"
                                id="other_lawReason" class="form-control" disabled="disabled">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="other_bank">曾有不良債信紀錄</label>
                            <select class="form-control form-select" name="other_bank" id="other_bank">
                                <option value="">請選擇</option>
                                <option value="1" @if ($query['other_bank'] == 1) selected @endif>無</option>
                                <option value="2" @if ($query['other_bank'] == 2) selected @endif>有</option>
                            </select>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="other_bankReason">原因</label>
                            <input type="text" value="{{ $query['other_bankReason'] }}" name="other_bankReason"
                                id="other_bankReason" class="form-control" disabled="disabled">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="other_infoSource">求職資訊來源</label>
                            <select class="form-control form-select" name="other_infoSource" id="other_infoSource">
                                <option value="">請選擇</option>
                                <option value="1" @if ($query['other_infoSource'] == 1) selected @endif>員工推薦
                                </option>
                                <option value="2" @if ($query['other_infoSource'] == 2) selected @endif>其他來源
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="other_infoSourceMemo">說明</label>
                            <input type="text" value="{{ $query['other_infoSourceMemo'] }}"
                                name="other_infoSourceMemo" id="other_infoSourceMemo" class="form-control">
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
                        <div class="form-group col-md-8">
                            <label for="other_workOvertimeMemo">說明</label>
                            <input type="text" value="{{ $query['other_workOvertimeMemo'] }}"
                                name="other_workOvertimeMemo" id="other_workOvertimeMemo" class="form-control"
                                disabled="disabled">
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
                        <div class="form-group col-md-8">
                            <label for="other_workOvertimeHolidayMemo">說明</label>
                            <input type="text" value="{{ $query['other_workOvertimeHolidayMemo'] }}"
                                name="other_workOvertimeHolidayMemo" id="other_workOvertimeHolidayMemo"
                                class="form-control" disabled="disabled">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-10R">
                            <label for="other_future">請說明您的生涯規劃</label>
                            <textarea class="form-control" name="other_future" id="other_future" rows="5" placeholder="">{{ $query['other_future'] }}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-check col-md-12 text-center">
                            <input class="form-check-input" type="checkbox" value="" id="formCheck">
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
            check_other_bank(); // 銀行
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
        // 法律
        $("#other_bank").on('change', function() {
            check_other_bank();
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
                $("#other_hospitalizedReason").attr('disabled', false);
            } else {
                $("#other_hospitalizedReason").attr('disabled', true);
            }
        }
        // 法律
        function check_other_law() {
            if ($("#other_law").val() == 2) {
                $("#other_lawReason").attr('disabled', false);
            } else {
                $("#other_lawReason").attr('disabled', true);
            }
        }
        // 銀行
        function check_other_bank() {
            if ($("#other_bank").val() == 2) {
                $("#other_bankReason").attr('disabled', false);
            } else {
                $("#other_bankReason").attr('disabled', true);
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
        function check_other_workOvertimeHoliday() {
            if ($("#other_workOvertimeHoliday").val() == 2) {
                $("#other_workOvertimeHolidayMemo").attr('disabled', false);
            } else {
                $("#other_workOvertimeHolidayMemo").attr('disabled', true);
            }
        }
    </script>

</body>

</html>
