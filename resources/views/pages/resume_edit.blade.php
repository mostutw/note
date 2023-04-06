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

    <title>{{ trans('resume.title_subject') }} | {{ trans('resume.title_company') }}</title>
</head>

<body>
    <div class="container full">
        <div class="row c-form-page">
            <form role="form" action="{{ url($url) }}" method="post">
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
                <div>
                    {{-- <img src="{{ asset('img/logo_icon.png') }}" class="c-img-banner" alt=""> --}}
                </div>
                <div class="col-sm-12 c-form-legend">
                    <p class="h2 text-center">{{ trans('resume.title_subject') }}</p>
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
                            <div class="form-group col-md-4 {{ $errors->first('interview_department') ? "has-error" : '' }}">
                                <label for="interview_department">{{ trans('resume.interview_department') }}</label>
                                <input type="text" value="{{ old('interview_department',$query['interview_department']) }}"
                                    name="interview_department" id="interview_department" class="form-control"
                                    placeholder="研發部">
                            </div>
                            <div class="form-group col-md-4 {{ $errors->first('interview_jobTitle') ? "has-error" : '' }}">
                                <label for="interview_jobTitle">{{ trans('resume.interview_jobTitle') }}</label>
                                <input type="text" value="{{ old('interview_jobTitle',$query['interview_jobTitle']) }}"
                                    name="interview_jobTitle" id="interview_jobTitle" class="form-control"
                                    placeholder="工程師">
                            </div>
                            <div class="form-group col-md-4 {{ $errors->first('interview_workDate') ? "has-error" : '' }}">
                                <label for="interview_workDate">{{ trans('resume.interview_workDate') }}</label>
                                <input type="date" value="{{ old('interview_workDate',$query['interview_workDate']) }}"
                                    name="interview_workDate" id="interview_workDate" class="form-control">
                            </div>
                            <div class="form-group col-md-4 {{ $errors->first('interview_salary') ? "has-error" : '' }}">
                                <label for="interview_salary">{{ trans('resume.interview_salary') }}</label>
                                <input type="number" value="{{ old('interview_salary',old('interview_salary',$query['interview_salary'])) }}" name="interview_salary"
                                    id="interview_salary" class="form-control" placeholder="50000">
                            </div>
                            <div class="form-group col-md-4 {{ $errors->first('interview_lowSalary') ? "has-error" : '' }}">
                                <label for="interview_lowSalary">{{ trans('resume.interview_lowSalary') }}</label>
                                <input type="number" value="{{ old('interview_lowSalary',$query['interview_lowSalary']) }}"
                                    name="interview_lowSalary" id="interview_lowSalary" class="form-control"
                                    placeholder="48000">
                            </div>
                        </div>
                    </div>
                    <!-- 個人基本資料 -->

                    <p class="h3 c-title">{{ trans('resume.title_info') }}</p>
                    <hr class="hr1">
                    <div class="row">
                        <div class="form-group col-md-4 {{ $errors->first('info_chineseName') ? "has-error" : '' }}">
                            <label for="info_chineseName"
                                class="required">{{ trans('resume.info_chineseName') }}</label>
                            <input type="text" value="{{ old('info_chineseName',$query['info_chineseName']) }}" name="info_chineseName"
                                id="info_chineseName" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group col-md-4 {{ $errors->first('info_englishName') ? "has-error" : '' }}">
                            <label for="info_englishName">{{ trans('resume.info_englishName') }}</label>
                            <input type="text" value="{{ old('info_englishName',$query['info_englishName']) }}" name="info_englishName"
                                id="info_englishName" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-2 {{ $errors->first('info_sex') ? "has-error" : '' }}">
                            <label for="info_sex" class="select required">{{ trans('resume.info_sex') }}</label>
                            <select class="form-control form-select" name="info_sex" id="info_sex" required>
                                @foreach ($select_list['info_sex'] as $key => $value)
                                    @if (old('info_sex',$query['info_sex']) == $key)
                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2 {{ $errors->first('info_marry') ? "has-error" : '' }}">
                            <label for="info_marry">{{ trans('resume.info_marry') }}</label>
                            <select class="form-control form-select" name="info_marry" id="info_marry">
                                @foreach ($select_list['info_marry'] as $key => $value)
                                    @if (old('info_marry',$query['info_marry']) == $key)
                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4 {{ $errors->first('info_id') ? "has-error" : '' }}">
                            <label for="info_id">{{ trans('resume.info_id') }}</label>
                            <input type="text" value="{{ old('info_id',$query['info_id']) }}" name="info_id" id="info_id"
                                class="form-control text-uppercase" placeholder="">
                        </div>
                        <div class="form-group col-md-4 {{ $errors->first('info_birthday') ? "has-error" : '' }}">
                            <label for="info_birthday">{{ trans('resume.info_birthday') }}</label>
                            <input type="date" value="{{ old('info_birthday',$query['info_birthday']) }}" name="info_birthday"
                                id="info_birthday" class="form-control">
                        </div>
                        <div class="form-group col-md-4 {{ $errors->first('info_birthplace') ? "has-error" : '' }}">
                            <label for="info_birthplace">{{ trans('resume.info_birthplace') }}</label>
                            <input type="text" value="{{ old('info_birthplace',$query['info_birthplace']) }}" name="info_birthplace"
                                id="info_birthplace" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4 {{ $errors->first('info_height') ? "has-error" : '' }}">
                            <label for="info_height">{{ trans('resume.info_height') }}</label>
                            <input type="number" value="{{ old('info_height',$query['info_height']) }}" name="info_height"
                                id="info_height" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-2 {{ $errors->first('info_weight') ? "has-error" : '' }}">
                            <label for="info_weight">{{ trans('resume.info_weight') }}</label>
                            <input type="number" value="{{ old('info_weight',$query['info_weight']) }}" name="info_weight"
                                id="info_weight" class=" form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-2 {{ $errors->first('info_blood') ? "has-error" : '' }}">
                            <label for="info_blood">{{ trans('resume.info_blood') }}</label>
                            <select class="form-control form-select" name="info_blood" id="info_blood">
                                @foreach ($select_list['info_blood'] as $key => $value)
                                    @if (old('info_blood',$query['info_blood']) == $key)
                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4 {{ $errors->first('info_colorPerception') ? "has-error" : '' }}">
                            <label for="info_colorPerception">{{ trans('resume.info_colorPerception') }}</label>
                            <select class="form-control form-select" name="info_colorPerception"
                                id="info_colorPerception">
                                @foreach ($select_list['info_colorPerception'] as $key => $value)
                                    @if (old('info_colorPerception',$query['info_colorPerception']) == $key)
                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2 {{ $errors->first('info_visionLeft') ? "has-error" : '' }}">
                            <label
                                for="info_visionLeft">{{ trans('resume.info_vision') }}({{ trans('resume.info_visionLeft') }})</label>
                            <input type="number" step="0.1" value="{{ old('info_visionLeft',$query['info_visionLeft']) }}"
                                name="info_visionLeft" id="info_visionLeft" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-2 {{ $errors->first('info_visionRight') ? "has-error" : '' }}">
                            <label
                                for="info_visionRight">{{ trans('resume.info_vision') }}({{ trans('resume.info_visionRight') }})</label>
                            <input type="number" value="{{ old('info_visionRight',$query['info_visionRight']) }}" name="info_visionRight"
                                id="info_visionRight" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4 {{ $errors->first('info_disability') ? "has-error" : '' }}">
                            <label for="info_disability">{{ trans('resume.info_disability') }}</label>
                            <select class="form-control form-select" name="info_disability" id="info_disability">
                                @foreach ($select_list['info_disability'] as $key => $value)
                                    @if (old('info_disability',$query['info_disability']) == $key)
                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4 {{ $errors->first('info_disabilityType') ? "has-error" : '' }}">
                            <label for="info_disabilityType">{{ trans('resume.info_disabilityType') }}</label>
                            <input type="text" value="{{ old('info_disabilityType',$query['info_disabilityType']) }}"
                                name="info_disabilityType" id="info_disabilityType" class="form-control"
                                placeholder="" disabled="disabled">
                        </div>
                        <div class="form-group col-md-4 {{ $errors->first('info_disabilityLevel') ? "has-error" : '' }}">
                            <label for="info_disabilityLevel">{{ trans('resume.info_disabilityLevel') }}</label>
                            <input type="text" value="{{ old('info_disabilityLevel',$query['info_disabilityLevel']) }}"
                                name="info_disabilityLevel" id="info_disabilityLevel" class="form-control"
                                placeholder="" disabled="disabled">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4 {{ $errors->first('info_military') ? "has-error" : '' }}">
                            <label for="info_military">{{ trans('resume.info_military') }}</label>
                            <select class="form-control form-select" name="info_military" id="info_military">
                                @foreach ($select_list['info_military'] as $key => $value)
                                    @if (old('info_military',$query['info_military']) == $key)
                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4 {{ $errors->first('info_militaryDate') ? "has-error" : '' }}">
                            <label for="info_militaryDate">{{ trans('resume.info_militaryDate') }}</label>
                            <input type="date" value="{{ old('info_militaryDate',$query['info_militaryDate']) }}" name="info_militaryDate"
                                id="info_militaryDate" class="form-control" disabled="disabled">
                        </div>

                        <div class="form-group col-md-4 {{ $errors->first('info_militaryReason') ? "has-error" : '' }}">
                            <label for="info_militaryReason">{{ trans('resume.info_militaryReason') }}</label>
                            <input type="text" value="{{ old('info_militaryReason',$query['info_militaryReason']) }}"
                                name="info_militaryReason" id="info_militaryReason" class="form-control"
                                placeholder="" disabled="disabled">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-8 {{ $errors->first('info_email') ? "has-error" : '' }}">
                            <label for="info_email">{{ trans('resume.info_email') }}</label>
                            <input type="email" value="{{ old('info_email',$query['info_email']) }}" name="info_email"
                                id="info_email" class="form-control" placeholder="EMail">
                        </div>
                        <div class="form-group col-md-4 {{ $errors->first('info_phone') ? "has-error" : '' }}">
                            <label for="info_phone" class="">{{ trans('resume.info_phone') }}</label>
                            <input type="number" value="{{ old('info_phone',$query['info_phone']) }}" name="info_phone"
                                id="info_phone" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-8 {{ $errors->first('info_address') ? "has-error" : '' }}">
                            <label for="info_address">{{ trans('resume.info_address') }}</label>
                            <input type="text" value="{{ old('info_address',$query['info_address']) }}" name="info_address"
                                id="info_address" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-4 {{ $errors->first('info_telephone') ? "has-error" : '' }}">
                            <label for="info_telephone">{{ trans('resume.info_telephone') }}</label>
                            <input type="number" value="{{ old('info_telephone',$query['info_telephone']) }}" name="info_telephone"
                                id="info_telephone" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-8 {{ $errors->first('info_address_2') ? "has-error" : '' }}">
                            <label for="info_address_2">{{ trans('resume.info_address_2') }}</label>
                            <input type="text" value="{{ old('info_address_2',$query['info_address_2']) }}" name="info_address_2"
                                id="info_address_2" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-4 {{ $errors->first('info_telephone_2') ? "has-error" : '' }}">
                            <label for="info_telephone_2">{{ trans('resume.info_telephone_2') }}</label>
                            <input type="number" value="{{ old('info_telephone_2',$query['info_telephone_2']) }}" name="info_telephone_2"
                                id="info_telephone_2" class="form-control" placeholder="">
                        </div>
                    </div>
                    <!-- 教育背景/專業課程 -->
                    <p class="h3 c-title">
                        {{ trans('resume.title_education') }}{{ trans('resume.title_education_memo') }}</p>
                    <hr class="hr1">
                    @for ($i = 0; $i < 3; $i++)
                        <div class="row">
                            <div class="form-group col-md-2 ">
                                <input type="hidden" name="education[{{ $i }}][id]"
                                    value="{{ isset($education[$i]['id']) ? $education[$i]['id'] : '' }}">
                                <label for="education[{{ $i }}][schoolLevel]"
                                    @if ($i == 0) class="required" @endif>{{ trans('resume.school_level') }}</label>
                                <select class="form-control form-select"
                                    name="education[{{ $i }}][school_level]"
                                    @if ($i == 0) required @endif>
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
                            <div class="form-group col-md-4 ">
                                <label for="education[{{ $i }}][schoolName]"
                                    @if ($i == 0) class="required" @endif>{{ trans('resume.school_name') }}</label>
                                <input type="text"
                                    value="{{ isset($education[$i]['school_name']) ? $education[$i]['school_name'] : '' }}"
                                    name="education[{{ $i }}][school_name]" class="form-control"
                                    placeholder="" @if ($i == 0) required @endif>
                            </div>

                            <div class="form-group col-md-4 ">
                                <label for="education[{{ $i }}][schoolDepartment]"
                                    @if ($i == 0) class="required" @endif>{{ trans('resume.school_department') }}</label>
                                <input type="text"
                                    value="{{ isset($education[$i]['school_department']) ? $education[$i]['school_department'] : '' }}"
                                    name="education[{{ $i }}][school_department]" class="form-control"
                                    placeholder="" @if ($i == 0) required @endif>
                            </div>

                            <div class="form-group col-md-2 ">
                                <label for="education[{{ $i }}][schoolStatus]"
                                    @if ($i == 0) class="required" @endif>{{ trans('resume.school_status') }}</label>
                                <select class="form-control form-select"
                                    name="education[{{ $i }}][school_status]"
                                    @if ($i == 0) required @endif>
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
                            <div class="form-group col-md-2 ">
                                <label for="education[0][schoolStartDate]"
                                    @if ($i == 0) class="required" @endif>{{ trans('resume.school_startEndDate') }}</label>
                                <input type="month"
                                    value="{{ isset($education[$i]['school_startDate']) ? $education[$i]['school_startDate']->format('Y-m') : '' }}"
                                    name="education[{{ $i }}][school_startDate]" class="form-control"
                                    @if ($i == 0) required @endif>
                            </div>
                            <div class="form-group col-md-2 ">
                                <label for="education[0][schoolEndDate]">&nbsp;</label>
                                <input type="month"
                                    value="{{ isset($education[$i]['school_endDate']) ? $education[$i]['school_endDate']->format('Y-m') : '' }}"
                                    name="education[{{ $i }}][school_endDate]" class="form-control">
                            </div>

                            <div class="form-group col-md-6 ">
                                <label
                                    for="education[{{ $i }}][schoolThesisTopic]">{{ trans('resume.school_thesisTopic') }}</label>
                                <input type="text"
                                    value="{{ isset($education[$i]['school_thesisTopic']) ? $education[$i]['school_thesisTopic'] : '' }}"
                                    name="education[{{ $i }}][school_thesisTopic]" class="form-control"
                                    placeholder="">
                            </div>
                        </div>
                    @endfor
                    <div class="row">
                        <div class="form-group col-md-3 ">
                            <input type="hidden" name="course[0][id]"
                                value="{{ isset($course[0]['id']) ? $course[0]['id'] : '' }}">
                            <label for="course[0][courseName]"
                                class="">{{ trans('resume.course_name') }}</label>
                            <input type="text"
                                value="{{ isset($course[0]['course_name']) ? $course[0]['course_name'] : '' }}"
                                name="course[0][course_name]" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-3 ">
                            <label for="course[0][courseDepartment]"
                                class="">{{ trans('resume.course_department') }}</label>
                            <input type="text"
                                value="{{ isset($course[0]['course_department']) ? $course[0]['course_department'] : '' }}"
                                name="course[0][course_department]" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-2 ">
                            <label for="course[0][courseStartDate]"
                                class="">{{ trans('resume.course_startDate') }}</label>
                            <input type="month"
                                value="{{ isset($course[0]['course_startDate']) ? $course[0]['course_startDate']->format('Y-m') : '' }}"
                                name="course[0][course_startDate]" class="form-control">
                        </div>
                        <div class="form-group col-md-2 ">
                            <label for="course[0][courseEndDate]">&nbsp;</label>
                            <input type="month"
                                value="{{ isset($course[0]['course_endDate']) ? $course[0]['course_endDate']->format('Y-m') : '' }}"
                                name="course[0][course_endDate]" class="form-control">
                        </div>
                    </div>
                    <!-- 工作經歷 -->
                    <p class="h3 c-title">{{ trans('resume.title_exp') . trans('resume.title_exp_memo') }}</p>
                    <hr class="hr3">

                    @for ($i = 0; $i < 6; $i++)
                        <div class="row">
                            <br>
                            <input type="hidden" name="exp[{{ $i }}][id]"
                                value="{{ isset($exp[$i]['id']) ? $exp[$i]['id'] : '' }}">
                            <div class="form-group col-md-3 ">
                                <label for="exp_companyName">{{ trans('resume.exp_companyName') }}</label>
                                <input type="text" name="exp[{{ $i }}][exp_companyName]"
                                    value="{{ isset($exp[$i]['exp_companyName']) ? $exp[$i]['exp_companyName'] : '' }}"
                                    class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-3 ">
                                <label
                                    for="exp_companyDepartment">{{ trans('resume.exp_companyDepartment') }}</label>
                                <input type="text" name="exp[{{ $i }}][exp_companyDepartment]"
                                    value="{{ isset($exp[$i]['exp_companyDepartment']) ? $exp[$i]['exp_companyDepartment'] : '' }}"
                                    class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-3 ">
                                <label for="exp_jobTitle">{{ trans('resume.exp_jobTitle') }}</label>
                                <input type="text" name="exp[{{ $i }}][exp_jobTitle]"
                                    value="{{ isset($exp[$i]['exp_jobTitle']) ? $exp[$i]['exp_jobTitle'] : '' }}"
                                    class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-2 ">
                                <label for="exp_workPlace">{{ trans('resume.exp_workPlace') }}</label>
                                <input type="text" name="exp[{{ $i }}][exp_workPlace]"
                                    value="{{ isset($exp[$i]['exp_workPlace']) ? $exp[$i]['exp_workPlace'] : '' }}"
                                    class="form-control" placeholder="">
                            </div>

                            <div class="form-group col-md-2 ">
                                <label for="exp_startDate">{{ trans('resume.exp_startDate') }}</label>
                                <input type="month" name="exp[{{ $i }}][exp_startDate]"
                                    value="{{ isset($exp[$i]['exp_startDate']) ? $exp[$i]['exp_startDate']->format('Y-m') : '' }}"
                                    class="form-control">
                            </div>
                            <div class="form-group col-md-2 ">
                                <label for="exp_endDate">&nbsp;</label>
                                <input type="month" name="exp[{{ $i }}][exp_endDate]"
                                    value="{{ isset($exp[$i]['exp_endDate']) ? $exp[$i]['exp_endDate']->format('Y-m') : '' }}"
                                    class="form-control">
                            </div>
                            <div class="form-group col-md-5 ">
                                <label for="exp_leaveReason">{{ trans('resume.exp_leaveReason') }}</label>
                                <input type="text" name="exp[{{ $i }}][exp_leaveReason]"
                                    value="{{ isset($exp[$i]['exp_leaveReason']) ? $exp[$i]['exp_leaveReason'] : '' }}"
                                    class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-2 ">
                                <label for="exp_salary">{{ trans('resume.exp_salary') }}</label>
                                <input type="number" name="exp[{{ $i }}][exp_salary]"
                                    value="{{ isset($exp[$i]['exp_salary']) ? $exp[$i]['exp_salary'] : '' }}"
                                    class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-9 ">
                                <label for="exp_content">{{ trans('resume.exp_content') }}</label>
                                <textarea class="form-control mytextarea" name="exp[{{ $i }}][exp_content]" rows="6"
                                    placeholder="描述工作內容...">{{ isset($exp[$i]['exp_content']) ? $exp[$i]['exp_content'] : '' }}</textarea>
                            </div>
                        </div>
                        <hr class="hr3">
                    @endfor
                    <!-- 個人特質/專業能力 -->

                    <p class="h3 c-title">{{ trans('resume.title_feature') }}</p>
                    <hr class="hr4">
                    <div class="row">
                        <div class="form-group col-md-5 {{ $errors->first('feature_strength') ? "has-error" : '' }}">
                            <label for="feature_strength">{{ trans('resume.feature_strength') }}</label>
                            <input type="text" value="{{ old('feature_strength',$query['feature_strength']) }}" name="feature_strength"
                                id="feature_strength" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-5 {{ $errors->first('feature_weakness') ? "has-error" : '' }}">
                            <label for="feature_weakness">{{ trans('resume.feature_weakness') }}</label>
                            <input type="text" value="{{ old('feature_weakness',$query['feature_weakness']) }}" name="feature_weakness"
                                id="feature_weakness" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2 {{ $errors->first('feature_englishLevel') ? "has-error" : '' }}">
                            <label for="feature_englishLevel">{{ trans('resume.feature_englishLevel') }}</label>
                            <select class="form-control form-select" name="feature_englishLevel"
                                id="feature_englishLevel">
                                @foreach ($select_list['feature_englishLevel'] as $key => $value)
                                    @if (old('feature_englishLevel',$query['feature_englishLevel']) == $key)
                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2 {{ $errors->first('feature_taiwaneseHokkienLevel') ? "has-error" : '' }}">
                            <label
                                for="feature_taiwaneseHokkienLevel">{{ trans('resume.feature_taiwaneseHokkienLevel') }}</label>
                            <select class="form-control form-select" name="feature_taiwaneseHokkienLevel"
                                id="feature_taiwaneseHokkienLevel">
                                @foreach ($select_list['feature_taiwaneseHokkienLevel'] as $key => $value)
                                    @if (old('feature_taiwaneseHokkienLevel',$query['feature_taiwaneseHokkienLevel']) == $key)
                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-1 {{ $errors->first('feature_license') ? "has-error" : '' }}0">
                            <label for="feature_license">{{ trans('resume.feature_license') }}</label>
                            <textarea class="form-control" name="feature_license" id="feature_license" rows="3"
                                placeholder="AWS 架構師-助理認證">{{ old('feature_license',$query['feature_license']) }}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-1 {{ $errors->first('feature_skill') ? "has-error" : '' }}0">
                            <label for="feature_skill">{{ trans('resume.feature_skill') }}</label>
                            <textarea class="form-control" name="feature_skill" id="feature_skill" rows="3" placeholder="C#, MSSQL, Git">{{ old('feature_skill',$query['feature_skill']) }}</textarea>
                        </div>
                    </div>
                    <!-- 家庭狀況 -->

                    <p class="h3 c-title">{{ trans('resume.title_family') }}</p>
                    <hr class="hr4">

                    @for ($i = 0; $i < 6; $i++)
                        <div class="row">
                            <input type="hidden" name="family[{{ $i }}][id]"
                                value="{{ isset($family[$i]['id']) ? $family[$i]['id'] : '' }}">
                            <div class="form-group col-md-2 ">
                                <label for="family_title">{{ trans('resume.family_relation') }}</label>
                                <input type="text"
                                    value="{{ isset($family[$i]['family_title']) ? $family[$i]['family_title'] : '' }}"
                                    name="family[{{ $i }}][family_title]" class="form-control"
                                    placeholder="">
                            </div>
                            <div class="form-group col-md-2 ">
                                <label for="family_name">{{ trans('resume.family_name') }}</label>
                                <input type="text"
                                    value="{{ isset($family[$i]['family_name']) ? $family[$i]['family_name'] : '' }}"
                                    name="family[{{ $i }}][family_name]" class="form-control"
                                    placeholder="">
                            </div>
                            <div class="form-group col-md-2 ">
                                <label for="family_age">{{ trans('resume.family_age') }}</label>
                                <input type="number"
                                    value="{{ isset($family[$i]['family_age']) ? $family[$i]['family_age'] : '' }}"
                                    name="family[{{ $i }}][family_age]" class="form-control"
                                    placeholder="">
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="family_job">{{ trans('resume.family_job') }}</label>
                                <input type="text"
                                    value="{{ isset($family[$i]['family_job']) ? $family[$i]['family_job'] : '' }}"
                                    name="family[{{ $i }}][family_job]" class="form-control"
                                    placeholder="">
                            </div>
                        </div>
                    @endfor

                    <!-- 緊急聯絡 -->
                    <div class="row">
                        <div class="form-group col-md-2 {{ $errors->first('family_emergencyContactName') ? "has-error" : '' }}">
                            <label
                                for="family_emergencyContactName">{{ trans('resume.family_emergencyContact') }}</label>
                            <input type="text" value="{{ old('family_emergencyContactName',$query['family_emergencyContactName']) }}"
                                name="family_emergencyContactName" id="family_emergencyContactName"
                                class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-2 {{ $errors->first('family_emergencyContactPhone') ? "has-error" : '' }}">
                            <label
                                for="family_emergencyContactPhone">{{ trans('resume.family_emergencyContactPhone') }}</label>
                            <input type="number" value="{{ old('family_emergencyContactPhone',$query['family_emergencyContactPhone']) }}"
                                name="family_emergencyContactPhone" id="family_emergencyContactPhone"
                                class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-2 {{ $errors->first('family_emergencyContactRelation') ? "has-error" : '' }}">
                            <label
                                for="family_emergencyContactRelation">{{ trans('resume.family_emergencyContactRelation') }}</label>
                            <input type="text" value="{{ old('family_emergencyContactRelation',$query['family_emergencyContactRelation']) }}"
                                name="family_emergencyContactRelation" id="family_emergencyContactRelation"
                                class="form-control" placeholder="">
                        </div>
                    </div>
                    <!-- 推薦人 -->
                    <p class="h3 c-title">{{ trans('resume.title_recommend') }}</p>
                    <hr class="hr4">
                    <div class="row">
                        <div class="form-group col-md-2 {{ $errors->first('recommend_name') ? "has-error" : '' }}">
                            <label for="recommend_name">{{ trans('resume.recommend_name') }}</label>
                            <input type="text" value="{{ old('recommend_name',$query['recommend_name']) }}" name="recommend_name"
                                id="recommend_name" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-2 {{ $errors->first('recommend_phone') ? "has-error" : '' }}">
                            <label for="recommend_phone">{{ trans('resume.recommend_phone') }}</label>
                            <input type="number" value="{{ old('recommend_phone',$query['recommend_phone']) }}" name="recommend_phone"
                                id="recommend_phone" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-2 {{ $errors->first('recommend_relation') ? "has-error" : '' }}">
                            <label for="recommend_relation">{{ trans('resume.recommend_relation') }}</label>
                            <input type="text" value="{{ old('recommend_relation',$query['recommend_relation']) }}"
                                name="recommend_relation" id="recommend_relation" class="form-control"
                                placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2 {{ $errors->first('recommend_name_2') ? "has-error" : '' }}">
                            <label for="recommend_name_2">{{ trans('resume.recommend_name') }}</label>
                            <input type="text" value="{{ old('recommend_name_2',$query['recommend_name_2']) }}" name="recommend_name_2"
                                id="recommend_name_2" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-2 {{ $errors->first('recommend_phone_2') ? "has-error" : '' }}">
                            <label for="recommend_phone_2">{{ trans('resume.recommend_phone') }}</label>
                            <input type="number" value="{{ old('recommend_phone_2',$query['recommend_phone_2']) }}"
                                name="recommend_phone_2" id="recommend_phone_2" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-2 {{ $errors->first('recommend_relation_2') ? "has-error" : '' }}">
                            <label for="recommend_relation_2">{{ trans('resume.recommend_relation') }}</label>
                            <input type="text" value="{{ old('recommend_relation_2',$query['recommend_relation_2']) }}"
                                name="recommend_relation_2" id="recommend_relation_2" class="form-control"
                                placeholder="">
                        </div>
                    </div>

                    <!-- 其他個人狀況 -->

                    <p class="h3 c-title">{{ trans('resume.title_other') }}</p>
                    <hr class="hr4">
                    <div class="row">
                        <div class="form-group col-md-2 {{ $errors->first('other_pregnancy') ? "has-error" : '' }}">
                            <label for="other_pregnancy">{{ trans('resume.other_pregnancy') }}</label>
                            <select class="form-control form-select" name="other_pregnancy" id="other_pregnancy">
                                @foreach ($select_list['other_pregnancy'] as $key => $value)
                                    @if (old('other_pregnancy',$query['other_pregnancy']) == $key)
                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2 {{ $errors->first('other_hospitalized') ? "has-error" : '' }}">
                            <label for="other_hospitalized">{{ trans('resume.other_hospitalized') }}</label>
                            <select class="form-control form-select" name="other_hospitalized"
                                id="other_hospitalized">
                                @foreach ($select_list['other_hospitalized'] as $key => $value)
                                    @if (old('other_hospitalized',$query['other_hospitalized']) == $key)
                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6 {{ $errors->first('other_hospitalizedReason') ? "has-error" : '' }}">
                            <label
                                for="other_hospitalizedReason">{{ trans('resume.other_hospitalizedReason') }}</label>
                            <input type="text" value="{{ old('other_hospitalizedReason',$query['other_hospitalizedReason']) }}"
                                name="other_hospitalizedReason" id="other_hospitalizedReason" class="form-control"
                                disabled="disabled">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2 {{ $errors->first('other_law') ? "has-error" : '' }}">
                            <label for="other_law">{{ trans('resume.other_law') }}</label>
                            <select class="form-control form-select" name="other_law" id="other_law">
                                @foreach ($select_list['other_law'] as $key => $value)
                                    @if (old('other_law',$query['other_law']) == $key)
                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-8 {{ $errors->first('other_lawReason') ? "has-error" : '' }}">
                            <label for="other_lawReason">{{ trans('resume.other_lawReason') }}</label>
                            <input type="text" value="{{ old('other_lawReason',$query['other_lawReason']) }}" name="other_lawReason"
                                id="other_lawReason" class="form-control" disabled="disabled">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2 {{ $errors->first('other_bank') ? "has-error" : '' }}">
                            <label for="other_bank">{{ trans('resume.other_bank') }}</label>
                            <select class="form-control form-select" name="other_bank" id="other_bank">
                                @foreach ($select_list['other_bank'] as $key => $value)
                                    @if (old('other_bank',$query['other_bank']) == $key)
                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-8 {{ $errors->first('other_bankReason') ? "has-error" : '' }}">
                            <label for="other_bankReason">{{ trans('resume.other_bankReason') }}</label>
                            <input type="text" value="{{ old('other_bankReason',$query['other_bankReason']) }}" name="other_bankReason"
                                id="other_bankReason" class="form-control" disabled="disabled">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2 {{ $errors->first('other_infoSource') ? "has-error" : '' }}">
                            <label for="other_infoSource">{{ trans('resume.other_infoSource') }}</label>
                            <select class="form-control form-select" name="other_infoSource" id="other_infoSource">
                                @foreach ($select_list['other_infoSource'] as $key => $value)
                                    @if (old('other_infoSource',$query['other_infoSource']) == $key)
                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-8 {{ $errors->first('other_infoSourceMemo') ? "has-error" : '' }}">
                            <label for="other_infoSourceMemo">{{ trans('resume.other_infoSourceMemo') }}</label>
                            <input type="text" value="{{ old('other_infoSourceMemo',$query['other_infoSourceMemo']) }}"
                                name="other_infoSourceMemo" id="other_infoSourceMemo" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2 ">
                            <label for="other_workOvertime">{{ trans('resume.other_workOvertime') }}</label>
                            <select class="form-control form-select" name="other_workOvertime"
                                id="other_workOvertime">
                                @foreach ($select_list['other_workOvertime'] as $key => $value)
                                    @if (old('other_workOvertime',$query['other_workOvertime']) == $key)
                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-8 {{ $errors->first('other_workOvertimeMemo') ? "has-error" : '' }}">
                            <label for="other_workOvertimeMemo">{{ trans('resume.other_workOvertimeMemo') }}</label>
                            <input type="text" value="{{ old('other_workOvertimeMemo',$query['other_workOvertimeMemo']) }}"
                                name="other_workOvertimeMemo" id="other_workOvertimeMemo" class="form-control"
                                disabled="disabled">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2 {{ $errors->first('other_workOvertimeHoliday') ? "has-error" : '' }}">
                            <label
                                for="other_workOvertimeHoliday">{{ trans('resume.other_workOvertimeHoliday') }}</label>
                            <select class="form-control form-select" name="other_workOvertimeHoliday"
                                id="other_workOvertimeHoliday">
                                @foreach ($select_list['other_workOvertimeHoliday'] as $key => $value)
                                    @if (old('other_workOvertimeHoliday',$query['other_workOvertimeHoliday']) == $key)
                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-8 {{ $errors->first('other_workOvertimeHolidayMemo') ? "has-error" : '' }}">
                            <label
                                for="other_workOvertimeHolidayMemo">{{ trans('resume.other_workOvertimeHolidayMemo') }}</label>
                            <input type="text" value="{{ old('other_workOvertimeHolidayMemo',$query['other_workOvertimeHolidayMemo']) }}"
                                name="other_workOvertimeHolidayMemo" id="other_workOvertimeHolidayMemo"
                                class="form-control" disabled="disabled">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12 {{ $errors->first('other_future') ? "has-error" : '' }}">
                            <label for="other_future">{{ trans('resume.other_future') }}</label>
                            <textarea class="form-control" name="other_future" id="other_future" rows="5" placeholder="">{{ old('other_future',$query['other_future']) }}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-check col-md-12 text-center {{ $errors->first('other_promise') ? "has-error" : '' }}">
                            <input class="form-check-input" type="checkbox" name="other_promise" id="other_promise"
                                value="1" @if (old('other_promise',$query['other_promise'])) checked="checked" @endif required>
                            <label class="form-check-label" for="other_promise">
                                {{ trans('resume.other_promise') }}
                            </label>
                        </div>
                    </div>
                    <!-- form-column end -->
                </div>

                <div class="col-sm-12 c-form-footer text-center">
                    <div class="btn-group btn-group-lg">
                        <button type="submit" id="data_save"
                            class="btn btn-primary">{{ trans('resume.data_save') }}</button>
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
    <!-- tinymce -->
    <script src='https://cdn.tiny.cloud/1/hn3o0tmszhnrb0adtmub1316kgfdva1wwx1dcwivusv5n56a/tinymce/4/tinymce.min.js'>
    </script>
    <!-- custom -->
    <script>
        // document loaded / window loaded
        $(document).ready(function() {
            console.log("document loaded");
            check_info_sex(); // 性別連動
            check_info_disability(); // 身心障礙
            check_info_military(); // 兵役狀況
            check_other_hospitalized(); // 住院
            check_other_law(); // 法律
            check_other_bank(); // 銀行
            check_other_workOvertime(); // 加班
            check_other_workOvertimeHoliday(); // 例假日加班
            tinymce.init({
                selector: '.mytextarea',
                inline: true // 基本功能
            });
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
            if ($("#other_hospitalized").val() == 1) {
                $("#other_hospitalizedReason").attr('disabled', false);
            } else {
                $("#other_hospitalizedReason").attr('disabled', true);
            }
        }
        // 法律
        function check_other_law() {
            if ($("#other_law").val() == 1) {
                $("#other_lawReason").attr('disabled', false);
            } else {
                $("#other_lawReason").attr('disabled', true);
            }
        }
        // 銀行
        function check_other_bank() {
            if ($("#other_bank").val() == 1) {
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
