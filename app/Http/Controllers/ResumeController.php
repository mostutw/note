<?php

namespace App\Http\Controllers;

use App\Resume;
use App\ResumeEducation;
use App\ResumeCourse;
use App\ResumeExp;
use App\ResumeFamily;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Exception;
use Carbon\Carbon;
use DateTime;


class ResumeController extends Controller
{
    /**
     * 驗證規則
     */
    public $rules = [
        //TODO: 驗證規則
    ];
    /**
     * 選單
     */
    public $menu = [
        // 學歷
        'school_level' => [
            '' => '-',
            '12' => '博士',
            '11' => '碩士',
            '10' => '大學',
            '9' => '四技',
            '8' => '二技',
            '7' => '二專',
            '6' => '三專',
            '5' => '五專',
            '4' => '高中',
            '3' => '高職',
            '2' => '國中',
            '1' => '國小',
        ],
        // 就學狀況
        'school_status' => [
            '' => '-',
            '1' => '畢業',
            '2' => '肄業',
            '3' => '就學',
        ],
        // 填寫狀況
        'resume_status' => [
            '1' => '使用中',
            '2' => '已關閉',
        ],
        // 外部連結開放
        'resume_lock' => [
            '0' => 'Yes',
            '1' => 'No',
        ],
        // 性別
        'info_sex' => [
            '' => '-',
            '1' => '男',
            '2' => '女',
        ],
        // 血型
        'info_blood' => [
            '' => '-',
            'A' => 'A',
            'B' => 'B',
            'AB' => 'AB',
            'O' => 'O',
        ],
        // 婚姻
        'info_marry' => [
            '' => '-',
            '1' => '單身',
            '2' => '已婚',
        ],
        // 辨色
        'info_colorPerception' => [
            '' => '-',
            '1' => '正常',
            '2' => '色盲',
        ],
        // 身障
        'info_disability' => [
            '' => '-',
            '1' => '是',
            '2' => '否',
        ],
        // 兵役
        'info_military' => [
            '' => '-',
            '1' => '役畢',
            '2' => '免役',
            '3' => '代役',
        ],
        // 英文
        'feature_englishLevel' => [
            '' => '-',
            '1' => '精通',
            '2' => '中等',
            '3' => '略懂',
            '4' => '不懂',
        ],
        // 台語
        'feature_taiwaneseHokkienLevel' => [
            '' => '-',
            '1' => '精通',
            '2' => '中等',
            '3' => '略懂',
            '4' => '不懂',
        ],
        // 有無懷孕
        'other_pregnancy' => [
            '' => '-',
            '1' => '有',
            '2' => '無',
        ],
        // 住院/開刀記錄
        'other_hospitalized' => [
            '' => '-',
            '1' => '有',
            '2' => '無',
        ],
        // 刑事/民事記錄
        'other_law' => [
            '' => '-',
            '1' => '有',
            '2' => '無',
        ],
        // 曾有不良債信記錄
        'other_bank' => [
            '' => '-',
            '1' => '有',
            '2' => '無',
        ],
        // 平日加班
        'other_workOvertime' => [
            '' => '-',
            '1' => '可',
            '2' => '否',
        ],
        // 例假日加班
        'other_workOvertimeHoliday' => [
            '' => '-',
            '1' => '可',
            '2' => '否',
        ],
        // 求職資訊
        'other_infoSource' => [
            '' => '-',
            '1' => '員工推薦',
            '2' => '其他來源',
        ],
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $order_by = Input::get('order_by', 'id');
        $sort_by = Input::get('sort_by', 'desc');
        $table_search = Input::get('table_search', '');
        // 查詢
        $query = Resume::query()->orderBy($order_by, $sort_by);
        // 搜尋
        if ($table_search) {
            $query->where('name', 'like', '%' . $table_search . '%');
            $query->orWhere('phone', 'like', '%' . $table_search . '%');
        }
        $query = $query->simplePaginate(15);
        // 篩選
        $filters = [
            'table_search' => $table_search,
        ];
        // 綁定
        $binding = [
            'list' => $query,
            'filters' => $filters,
            'order_by' => $order_by,
            'sort_by' => $sort_by,
            'select_list' => $this->menu,
        ];
        // dd($binding);
        return view('pages.resume_list', $binding);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.resume_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|numeric|digits_between:9,15',
        ]);

        Resume::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'user_id' => Auth::user()->id,
            'status' => 1,
            'uuid' => Str::uuid(),
        ]);

        return redirect('pages/resumes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param  \App\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function show($id, Resume $resume)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @param  \App\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Resume $resume)
    {
        $query = $resume::findOrFail($id);

        $binding = [
            'query' => $query,
            'education' => $query->resume_education,
            'course' => $query->resume_course,
            'exp' => $query->resume_exp,
            'family' => $query->resume_family,
            'select_list' => $this->menu,
            'url' => 'pages/resumes/' . $id,
        ];
        // dd($binding);
        return view('pages.resume_edit', $binding);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resume $resume)
    {
        $query = $resume->findOrFail($request->id);
        $return = $this->saveData($query);

        return $return == true ? redirect()->back()->with('success', 'Profile updated!') : redirect()->back()->with('fail', 'Error!');    // return redirect()->back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Resume  $resume
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resume $resume, Request $request)
    {
        $query = $resume->findOrFail($request->id);
        $query->delete();

        return redirect('pages/resumes')->with('success', 'Profile deleted!');
    }

    /**
     * Show the form for editing the specified resource.
     * @param string $uuid
     * @param  \App\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function editForPublic($uuid, Resume $resume)
    {
        $query = $resume->where(['uuid' => $uuid, 'lock' => 0])->firstOrFail(); // lock 0 未上鎖

        $binding = [
            'query' => $query,
            'education' => $query->resume_education,
            'course' => $query->resume_course,
            'exp' => $query->resume_exp,
            'family' => $query->resume_family,
            'select_list' => $this->menu,
            'uuid' => $uuid,
            'url' => 'public/resumes/' . $uuid,
        ];
        // dd($binding);
        return view('pages.resume_edit', $binding);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  string  $uuid
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function updateForPublic($uuid, Request $request, Resume $resume)
    {
        $query = $resume->where(['uuid' => $uuid, 'lock' => 0])->firstOrFail();
        $return = $this->saveData($query);
        return $return == true ? redirect('public/resumes/' . $uuid . '/edit')->with('success', 'Profile updated!') : redirect('public/resumes/' . $uuid . '/edit')->with('fail', 'Error!');
    }

    /**
     * Update the lock status of a profile
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateLock(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'lock' => 'required|boolean',
        ]);

        $query = Resume::findOrFail($request->id);
        $query->lock = $request->input('lock');
        $query->save();

        return json_encode('success');
    }

    /**
     * Update the user data of a profile
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string',
            'phone' => 'required|numeric',
        ]);

        $query = Resume::findOrFail($request->id);
        $query->name = $request->input('name');
        $query->phone = $request->input('phone');
        $query->save();

        return json_encode('success');
    }

    /**
     * Save data
     * 
     * @param  object $query
     * @return boolean true if successful, false
     */
    public function saveData($query)
    {
        // dd($query->id);
        $query->interview_department = Input::get('interview_department');
        $query->interview_jobTitle = Input::get('interview_jobTitle');
        $query->interview_workDate = Input::get('interview_workDate');
        $query->interview_salary = Input::get('interview_salary');
        $query->interview_lowSalary = Input::get('interview_lowSalary');
        $query->interview_applyDate = empty($query->interview_applyDate) ? Carbon::now() : $query->interview_applyDate;
        $query->info_chineseName = Input::get('info_chineseName');
        $query->info_englishName = Input::get('info_englishName');
        $query->info_sex = Input::get('info_sex');
        $query->info_marry = Input::get('info_marry');
        $query->info_id = Input::get('info_id');
        $query->info_birthday = Input::get('info_birthday');
        $query->info_birthplace = Input::get('info_birthplace');
        $query->info_height = Input::get('info_height');
        $query->info_weight = Input::get('info_weight');
        $query->info_blood = Input::get('info_blood');
        $query->info_colorPerception = Input::get('info_colorPerception');
        $query->info_visionLeft = Input::get('info_visionLeft');
        $query->info_visionRight = Input::get('info_visionRight');
        $query->info_disability = Input::get('info_disability');
        $query->info_disabilityType = Input::get('info_disabilityType');
        $query->info_disabilityLevel = Input::get('info_disabilityLevel');
        $query->info_military = Input::get('info_military');
        $query->info_militaryDate = Input::get('info_militaryDate');
        $query->info_militaryReason = Input::get('info_militaryReason');
        $query->info_email = Input::get('info_email');
        $query->info_phone = Input::get('info_phone');
        $query->info_address = Input::get('info_address');
        $query->info_telephone = Input::get('info_telephone');
        $query->info_address_2 = Input::get('info_address_2');
        $query->info_telephone_2 = Input::get('info_telephone_2');
        $query->feature_strength = Input::get('feature_strength');
        $query->feature_weakness = Input::get('feature_weakness');
        $query->feature_englishLevel = Input::get('feature_englishLevel');
        $query->feature_taiwaneseHokkienLevel = Input::get('feature_taiwaneseHokkienLevel');
        $query->feature_license = Input::get('feature_license');
        $query->feature_skill = Input::get('feature_skill');
        $query->family_emergencyContactName = Input::get('family_emergencyContactName');
        $query->family_emergencyContactPhone = Input::get('family_emergencyContactPhone');
        $query->family_emergencyContactRelation = Input::get('family_emergencyContactRelation');
        $query->recommend_name = Input::get('recommend_name');
        $query->recommend_phone = Input::get('recommend_phone');
        $query->recommend_relation = Input::get('recommend_relation');
        $query->recommend_name_2 = Input::get('recommend_name_2');
        $query->recommend_phone_2 = Input::get('recommend_phone_2');
        $query->recommend_relation_2 = Input::get('recommend_relation_2');
        $query->other_pregnancy = Input::get('other_pregnancy');
        $query->other_hospitalized = Input::get('other_hospitalized');
        $query->other_hospitalizedReason = Input::get('other_hospitalizedReason');
        $query->other_law = Input::get('other_law');
        $query->other_lawReason = Input::get('other_lawReason');
        $query->other_bank = Input::get('other_bank');
        $query->other_bankReason = Input::get('other_bankReason');
        $query->other_infoSource = Input::get('other_infoSource');
        $query->other_infoSourceMemo = Input::get('other_infoSourceMemo');
        $query->other_workOvertime = Input::get('other_workOvertime');
        $query->other_workOvertimeMemo = Input::get('other_workOvertimeMemo');
        $query->other_workOvertimeHoliday = Input::get('other_workOvertimeHoliday');
        $query->other_workOvertimeHolidayMemo = Input::get('other_workOvertimeHolidayMemo');
        $query->other_future = Input::get('other_future');
        $query->other_promise = Input::get('other_promise');
        // exp update
        foreach (Input::get('exp') as $value) {
            ResumeExp::updateOrCreate(
                ['id' => $value['id']],
                [
                    'resumes_id' => $query->id,
                    'exp_companyName' => $value['exp_companyName'],
                    'exp_companyDepartment' => $value['exp_companyDepartment'],
                    'exp_jobTitle' => $value['exp_jobTitle'],
                    'exp_workPlace' => $value['exp_workPlace'],
                    'exp_salary' => $value['exp_salary'],
                    'exp_startDate' => !empty($value['exp_startDate']) ? $value['exp_startDate'] . '-' . '01' : null,
                    'exp_endDate' => !empty($value['exp_endDate']) ? $value['exp_endDate'] . '-' . '01'  : null,
                    'exp_content' => htmlspecialchars($value['exp_content']),
                    'exp_leaveReason' => $value['exp_leaveReason'],
                ]
            );
        }
        // education update
        foreach (Input::get('education') as $value) {
            ResumeEducation::updateOrCreate(
                ['id' => $value['id']],
                [
                    'resumes_id' => $query->id,
                    'school_level' => $value['school_level'],
                    'school_name' => $value['school_name'],
                    'school_department' => $value['school_department'],
                    'school_status' => $value['school_status'],
                    'school_startDate' => !empty($value['school_startDate']) ? $value['school_startDate'] . '-' . '01'  : null,
                    'school_endDate' => !empty($value['school_endDate']) ? $value['school_endDate'] . '-' . '01'  : null,
                    'school_thesisTopic' => $value['school_thesisTopic'],
                ]
            );
        }
        // course update
        foreach (Input::get('course') as $value) {
            ResumeCourse::updateOrCreate(
                ['id' => $value['id']],
                [
                    'resumes_id' => $query->id,
                    'course_name' => $value['course_name'],
                    'course_department' => $value['course_department'],
                    'course_startDate' => !empty($value['course_startDate']) ? $value['course_startDate'] . '-' . '01'  : null,
                    'course_endDate' => !empty($value['course_endDate']) ? $value['course_endDate'] . '-' . '01'  : null,
                ]
            );
        }
        // family update
        foreach (Input::get('family') as $value) {
            ResumeFamily::updateOrCreate(
                ['id' => $value['id']],
                [
                    'resumes_id' => $query->id,
                    'family_title' => $value['family_title'],
                    'family_name' => $value['family_name'],
                    'family_age' => $value['family_age'],
                    'family_job' => $value['family_job'],
                ]
            );
        }
        // dd('$query');
        return $query->save();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function export($id, Resume $resume)
    {
        // user data
        $o_resume = $resume::findOrFail($id);
        // dd($o_resume);
        $header = [
            '0' => [
                'bold' => true,
                'size' => 24,
                'name' => 'DFKai-SB',
            ],
            '1' => [
                'bold' => true,
                'size' => 12,
                'name' => 'DFKai-SB',
                'color' => '000000',
            ],
            '1' => [
                'bold' => false,
                'size' => 10,
                'name' => 'DFKai-SB',
            ],
        ];
        $tableStyle = [
            'base' => [
                'borderSize'  => 2,
                'cellMarginTop'  => 20,
                'cellMarginBottom'  => 20,
                'cellMarginLeft'  => 20,
                'cellMarginRight'  => 20,
            ],
        ];
        $cellStyle = [
            'na' => [],
            'title' => [
                'bgcolor' => 'F2F2F2', // 底色
            ],
        ];
        $textStyle = [
            'title_zh_tw' => [
                'bold' => true,
                'size' => 10,
                'name' => 'DFKai-SB',
            ],
            'title_en_us' => [
                'bold' => true,
                'size' => 10,
                'name' => 'Times New Roman',
            ],
            'zh_tw' => [
                'bold' => false,
                'size' => 10,
                'name' => 'DFKai-SB',
            ],
            'en_us' => [
                'bold' => false,
                'size' => 10,
                'name' => 'Times New Roman',
            ],

        ];
        $color = [
            'blue' => '92CDDC',
            'white' => 'FFFFFF',
            'black' => '000000',
        ];
        $cm = [
            '0.1' => 56.692913386,
            '0.5' => 283.46456693,
            '1' => 566.92913386,
            '2' => 1133.8582677,
            '2.8' => 1587.4015748,
            '2.5' => 1417.3228346,
            '2.91' => 1649.76377953,
            '3' => 1700.7874016,
            '3.5' => 1984.2519685,
            '4' => 2267.7165354,
            '4.5' => 2551.1811024,
            '5' => 2834.6456693,
            '6' => 3401.5748031,
            '7' => 3968.503937,
            '7.5' => 4251.96850395,
            '8' => 4535.4330709,
            '9' => 5102.3622047,
            '10' => 5669.2913386,
            '11' => 6236.2204724,
            '12' => 6803.1496063,
            '13' => 7370.0787402,
            '14' => 7937.007874,
            '15' => 8503.9370079,
            '16' => 9070.8661417,
            '17' => 9637.7952756,
            '18' => 10204.724409,
        ];
        $cellRowContinue = ['vMerge' => 'continue'];
        $cellHCentered = ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER];
        // new
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->addParagraphStyle('pStyle', $cellHCentered);
        $section = $phpWord->addSection();
        // set page margin
        $sectionStyle = $section->getStyle();
        $sectionStyle->setMarginTop(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1));
        $sectionStyle->setMarginLeft(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1));
        $sectionStyle->setMarginRight(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1));
        $sectionStyle->setMarginBottom(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1));
        // set data
        $a_set = [
            'logo' => Storage::disk('save')->exists('logo_icon.png') ? Storage::path('save/logo_icon.png') : false,
            'fileName' => !empty($o_resume['info_chineseName']) ? $o_resume['info_chineseName'] : 'resume',
            'info_sex' => $this->menu['info_sex'][$o_resume['info_sex']],
            'interview_applyDate' => $this->dateFormatRepublicOfChinaType1($o_resume['interview_applyDate']),
            'interview_workDate' => $this->dateFormatRepublicOfChinaType1($o_resume['interview_workDate']),
            'info_birthday' => $this->dateFormatRepublicOfChinaType1($o_resume['info_birthday']),
            'info_marry' => $this->menu['info_marry'][$o_resume['info_marry']],
            'info_colorPerception' => $this->menu['info_colorPerception'][$o_resume['info_colorPerception']],
            'info_disability' => $this->menu['info_disability'][$o_resume['info_disability']],
            'info_military' => $this->menu['info_military'][$o_resume['info_military']],
            'other_pregnancy' => $this->menu['other_pregnancy'][$o_resume['other_pregnancy']],
            'resume_education' => collect($o_resume->resume_education)->sortBy('school_level'),
            'resume_education_school_thesisTopic' => '',
            'resume_course' => $o_resume->resume_course,
            'exp_content_count_rows' => 0,
            'exp_content_one_row_max' => 153, // 153字元 為工作描述 1行 所能容納的最大字元數
            'exp_content_one_page_max' => 51, // 51行 為工作經歷一頁 所能容納的最大行數
            'exp_content_base_rows' => 2, // 其他資訊佔 2行
        ];

        if (true) { // 頁首
            $headerText = $section->addHeader();
            $table = $headerText->addTable();
            $table->addRow();
            $table->addCell($cm[9])->addImage($a_set['logo'], ['width' => '245', 'height' => '50']);
            $table->addCell($cm[3])->addText('');
            $table->addCell($cm[5])->addText(trans('resume.title_subject'), $header[0], ['spaceBefore' => 250]);
            $table = $headerText->addTable();
            $table->addRow();
            $table->addCell($cm[7])->addText(trans('resume.title_limit'), $textStyle['zh_tw']);
            $table->addCell($cm[7])->addText(trans('resume.title_level'), $textStyle['zh_tw']);
            $table->addCell($cm[1])->addText(trans('resume.title_no'), $textStyle['zh_tw']);
        }

        if (true) { // 頁尾
            $footer = $section->addFooter();
            $footer->addPreserveText(
                '{PAGE} of {NUMPAGES}',
                ['color' => '000000'],
                ['align' => 'center'],
            );
        }

        if (true) { // 0.應徵單位
            $tableName = '';
            $phpWord->addTableStyle($tableName, $tableStyle['base']);
            $table = $section->addTable($tableName);

            $table->addRow();
            $table->addCell($cm[4], $cellStyle['title'])->addText(trans('resume.interview_department'), $textStyle['title_zh_tw'], 'pStyle');
            $table->addCell($cm[4], $cellStyle['na'])->addText($o_resume['interview_department'], $textStyle['zh_tw']);
            $table->addCell($cm[4], $cellStyle['title'])->addText(trans('resume.interview_jobTitle'), $textStyle['title_zh_tw'], 'pStyle');
            $table->addCell($cm[4], $cellStyle['na'])->addText($o_resume['interview_jobTitle'], $textStyle['zh_tw']);
            $table->addCell($cm[4], $cellStyle['title'])->addText(trans('resume.interview_applyDate'), $textStyle['title_zh_tw'], 'pStyle');
            $table->addCell($cm[4], $cellStyle['na'])->addText($a_set['interview_applyDate'], $textStyle['zh_tw']);

            $table->addRow();
            $table->addCell($cm[4], $cellStyle['title'])->addText(trans('resume.interview_salary'), $textStyle['title_zh_tw'], 'pStyle');
            $table->addCell($cm[4], $cellStyle['na'])->addText($o_resume['interview_salary'], $textStyle['zh_tw']);
            $table->addCell($cm[4], $cellStyle['title'])->addText(trans('resume.interview_lowSalary'), $textStyle['title_zh_tw'], 'pStyle');
            $table->addCell($cm[4], $cellStyle['na'])->addText($o_resume['interview_lowSalary'], $textStyle['zh_tw']);
            $table->addCell($cm[4], $cellStyle['title'])->addText(trans('resume.interview_workDate'), $textStyle['title_zh_tw'], 'pStyle');
            $table->addCell($cm[4], $cellStyle['na'])->addText($a_set['interview_workDate'], $textStyle['zh_tw']);
        }

        if (true) { // 1.個人基本資料
            $tableName1 = trans('resume.title_info');
            $phpWord->addTableStyle($tableName1, $tableStyle['base']);
            $table1 = $section->addTable($tableName1);

            $row = $table1->addRow();
            $row->addCell(11000, ['gridSpan' => 7, 'vMerge' => 'restart', 'bgcolor' => $color['blue']])->addText($tableName1, $header[1]);

            $row = $table1->addRow();
            $row->addCell($cm[3], $cellStyle['title'])->addText(trans('resume.info_chineseName'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[3], $cellStyle['na'])->addText($o_resume['info_chineseName'], $textStyle['zh_tw']);
            $row->addCell($cm[3], $cellStyle['title'])->addText(trans('resume.info_englishName'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[4], $cellStyle['na'])->addText($o_resume['info_englishName'], $textStyle['en_us']);
            $row->addCell($cm[3], $cellStyle['title'])->addText(trans('resume.info_sex'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[3], $cellStyle['na'])->addText($a_set['info_sex'], $textStyle['zh_tw']);
            $row->addCell($cm[4], ['vMerge' => 'restart', 'valign' => 'center'])->addText(trans('resume.info_photo'), $textStyle['zh_tw'], 'pStyle');

            $row = $table1->addRow();
            $row->addCell($cm[1], $cellStyle['title'])->addText(trans('resume.info_id'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($o_resume['info_id'], $textStyle['en_us']);
            $row->addCell($cm[1], $cellStyle['title'])->addText(trans('resume.info_birthday'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($a_set['info_birthday'], $textStyle['zh_tw']);
            $row->addCell($cm[1], $cellStyle['title'])->addText(trans('resume.info_marry'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($a_set['info_marry'], $textStyle['zh_tw']);
            $row->addCell($cm[1], $cellRowContinue);

            $row = $table1->addRow();
            $row->addCell($cm[1], $cellStyle['title'])->addText(trans('resume.info_birthplace'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($o_resume['info_birthplace'], $textStyle['zh_tw']);
            $row->addCell($cm[1], $cellStyle['title'])->addText(trans('resume.info_colorPerception'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($a_set['info_colorPerception'], $textStyle['zh_tw']);
            $row->addCell($cm[1], $cellStyle['title'])->addText(trans('resume.info_vision'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText(trans('resume.info_visionLeft') . ":" . $o_resume['info_visionLeft'] . " " . trans('resume.info_visionRight') . ":" . $o_resume['info_visionRight'], $textStyle['zh_tw']);
            $row->addCell($cm[1], $cellRowContinue);

            $row = $table1->addRow();
            $row->addCell($cm[1], $cellStyle['title'])->addText(trans('resume.info_blood'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($o_resume['info_blood'], $textStyle['en_us']);
            $row->addCell($cm[1], $cellStyle['title'])->addText(trans('resume.info_height'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($o_resume['info_height'] . trans('resume.info_height_unit'), $textStyle['zh_tw']);
            $row->addCell($cm[1], $cellStyle['title'])->addText(trans('resume.info_weight'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($o_resume['info_weight'] . trans('resume.info_weight_unit'), $textStyle['zh_tw']);
            $row->addCell($cm[1], $cellRowContinue);

            $row = $table1->addRow();
            $row->addCell($cm[1], $cellStyle['title'])->addText(trans('resume.info_disability'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($a_set['info_disability'], $textStyle['zh_tw']);
            $row->addCell($cm[1], $cellStyle['title'])->addText(trans('resume.info_disabilityType'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($o_resume['info_disabilityType'], $textStyle['zh_tw']);
            $row->addCell($cm[1], $cellStyle['title'])->addText(trans('resume.info_disabilityLevel'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($o_resume['info_disabilityLevel'], $textStyle['zh_tw']);
            $row->addCell($cm[1], $cellRowContinue);

            $row = $table1->addRow();
            $row->addCell($cm[1], $cellStyle['title'])->addText(trans('resume.info_email'), $textStyle['title_en_us'], 'pStyle');
            $row->addCell($cm[1], ['gridSpan' => 3])->addText($o_resume['info_email'], $textStyle['en_us']);
            $row->addCell($cm[1], $cellStyle['title'])->addText(trans('resume.info_phone'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($o_resume['info_phone'], $textStyle['en_us']);
            $row->addCell($cm[1], $cellRowContinue);

            $row = $table1->addRow();
            $row->addCell($cm[1], $cellStyle['title'])->addText(trans('resume.info_address'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], ['gridSpan' => 3])->addText($o_resume['info_address'], $textStyle['zh_tw']);
            $row->addCell($cm[1], $cellStyle['title'])->addText(trans('resume.info_telephone'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($o_resume['info_telephone'], $textStyle['en_us']);
            $row->addCell($cm[1], $cellRowContinue);

            $row = $table1->addRow();
            $row->addCell($cm[1], $cellStyle['title'])->addText(trans('resume.info_address_2'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], ['gridSpan' => 3])->addText($o_resume['info_address_2'], $textStyle['zh_tw']);
            $row->addCell($cm[1], $cellStyle['title'])->addText(trans('resume.info_telephone_2'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($o_resume['info_telephone_2'], $textStyle['en_us']);
            $row->addCell($cm[1], $cellRowContinue);

            $row = $table1->addRow();
            $row->addCell($cm[1], $cellStyle['title'])->addText(trans('resume.info_military'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], ['gridSpan' => 3])->addText($a_set['info_military'] . " " . $o_resume['info_militaryDate'], $textStyle['zh_tw']);
            $row->addCell($cm[1], $cellStyle['title'])->addText(trans('resume.info_militaryReason'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], ['gridSpan' => 2])->addText($o_resume['info_militaryReason'], $textStyle['zh_tw']);
        }

        if (true) { // 2.教育背景
            $tableName2 = trans('resume.title_education');
            $phpWord->addTableStyle($tableName2, $tableStyle['base']);
            $table2 = $section->addTable($tableName2);

            $row = $table2->addRow();
            $row->addCell(11000, ['gridSpan' => 5,  'vMerge' => 'restart',  'bgcolor' => $color['blue']])->addText($tableName2, $header[1]);

            $row = $table2->addRow();
            $row->addCell($cm[3], $cellStyle['title'])->addText(trans('resume.school_level'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[4], $cellStyle['title'])->addText(trans('resume.school_name'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[4], $cellStyle['title'])->addText(trans('resume.school_department'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[4], $cellStyle['title'])->addText(trans('resume.school_startEndDate'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[5], $cellStyle['title'])->addText(trans('resume.school_status'), $textStyle['title_zh_tw'], 'pStyle');

            foreach ($a_set['resume_education'] as $education) {
                $row = $table2->addRow();
                $row->addCell($cm[1], $cellStyle['title'])->addText($this->menu['school_level'][$education['school_level']], $textStyle['title_zh_tw'], 'pStyle');
                $row->addCell($cm[1], $cellStyle['na'])->addText($education['school_name'], $textStyle['zh_tw']);
                $row->addCell($cm[1], $cellStyle['na'])->addText($education['school_department'], $textStyle['zh_tw']);
                $row->addCell($cm[1], $cellStyle['na'])->addText($this->dateFormatRepublicOfChinaType2($education['school_startDate']) . ' - ' . $this->dateFormatRepublicOfChinaType2($education['school_endDate']), $textStyle['en_us'], 'pStyle');
                $row->addCell($cm[1], $cellStyle['na'])->addText($this->menu['school_status'][$education['school_status']], $textStyle['zh_tw'], 'pStyle');
                $a_set['resume_education_school_thesisTopic'] .= $education['school_level'] == 11 || $education['school_level'] == 12 ? $this->menu['school_level'][$education['school_level']] . ":" . $education['school_thesisTopic'] . ' ' : ' ';
            }

            foreach ($a_set['resume_course'] as $course) {
                $row = $table2->addRow();
                $row->addCell($cm[1], $cellStyle['title'])->addText(trans('resume.course_name'), $textStyle['title_zh_tw'], 'pStyle');
                $row->addCell($cm[1], $cellStyle['na'])->addText($course['course_name'], $textStyle['zh_tw']);
                $row->addCell($cm[1], $cellStyle['na'])->addText($course['course_department'], $textStyle['zh_tw']);
                $row->addCell($cm[1], $cellStyle['na'])->addText($this->dateFormatRepublicOfChinaType2($course['course_startDate']) . ' - ' . $this->dateFormatRepublicOfChinaType2($course['course_endDate']), $textStyle['en_us'], 'pStyle');
                $row->addCell($cm[1], $cellStyle['na'])->addText('-', $textStyle['zh_tw'], 'pStyle');
            }

            $row = $table2->addRow();
            $row->addCell($cm[1], $cellStyle['title'])->addText(trans('resume.school_thesisTopic'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], ['gridSpan' => 4])->addText($a_set['resume_education_school_thesisTopic'], $textStyle['zh_tw']);
        }

        if (true) { // 4.個人特質/專業能力
            $tableName4 = trans('resume.title_feature');
            $phpWord->addTableStyle($tableName4, $tableStyle['base']);
            $table4 = $section->addTable($tableName4);

            $row = $table4->addRow();
            $row->addCell(11000, ['gridSpan' => 4, 'vMerge' => 'restart', 'bgcolor' => $color['blue']])->addText($tableName4, $header[1]);

            $row = $table4->addRow();
            $row->addCell($cm[2], $cellStyle['title'])->addText(trans('resume.feature_strength'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[6], $cellStyle['na'])->addText($o_resume['feature_strength'], $textStyle['zh_tw']);
            $row->addCell($cm[2], $cellStyle['title'])->addText(trans('resume.feature_weakness'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[6], $cellStyle['na'])->addText($o_resume['feature_weakness'], $textStyle['zh_tw']);

            $row = $table4->addRow();
            $row->addCell($cm[1], $cellStyle['title'])->addText(trans('resume.feature_language'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText(trans('resume.feature_englishLevel') . ":" . $this->menu['feature_englishLevel'][$o_resume['feature_englishLevel']] . ' ' . trans('resume.feature_taiwaneseHokkienLevel') . ":" .  $this->menu['feature_taiwaneseHokkienLevel'][$o_resume['feature_taiwaneseHokkienLevel']], $textStyle['zh_tw']);
            $row->addCell($cm[1], $cellStyle['title'])->addText(trans('resume.feature_license'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($o_resume['feature_license'], $textStyle['zh_tw']);

            $row = $table4->addRow();
            $row->addCell($cm[1], $cellStyle['title'])->addText(trans('resume.feature_skill'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[16], ['gridSpan' => 3])->addText($o_resume['feature_skill'], $textStyle['zh_tw']);
        }

        if (true) { // 5.家庭狀況
            $tableName5 = trans('resume.title_family');
            $phpWord->addTableStyle($tableName5, $tableStyle['base']);
            $table5 = $section->addTable($tableName5);

            $row = $table5->addRow();
            $row->addCell(11000, ['gridSpan' => 10, 'vMerge' => 'restart', 'bgcolor' => $color['blue']])->addText($tableName5, $header[1]);

            $row = $table5->addRow();
            $row->addCell($cm[1], $cellStyle['title'])->addText("", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[3], $cellStyle['title'])->addText(trans('resume.family_relation'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[4], $cellStyle['title'])->addText(trans('resume.family_name'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[3], $cellStyle['title'])->addText(trans('resume.family_age'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[4], $cellStyle['title'])->addText(trans('resume.family_age'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['title'])->addText("", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[3], $cellStyle['title'])->addText(trans('resume.family_relation'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[4], $cellStyle['title'])->addText(trans('resume.family_name'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[3], $cellStyle['title'])->addText(trans('resume.family_age'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[4], $cellStyle['title'])->addText(trans('resume.family_age'), $textStyle['title_zh_tw'], 'pStyle');


            foreach ($o_resume->resume_family as $i => $family) {
                if ($i % 2 == 0) {
                    $row = $table5->addRow();
                }
                $row->addCell($cm[2], $textStyle['en_us'])->addText($i + 1, $textStyle['en_us'], 'pStyle');
                $row->addCell($cm[4], $cellStyle['na'])->addText($family['family_title'], $textStyle['zh_tw'], 'pStyle');
                $row->addCell($cm[4], $cellStyle['na'])->addText($family['family_name'], $textStyle['zh_tw'], 'pStyle');
                $row->addCell($cm[4], $textStyle['en_us'])->addText($family['family_age'], $textStyle['en_us'], 'pStyle');
                $row->addCell($cm[4], $cellStyle['na'])->addText($family['family_job'], $textStyle['zh_tw'], 'pStyle');
            }

            $row = $table5->addRow();
            $row->addCell($cm[3], ['gridSpan' => 2])->addText(trans('resume.family_emergencyContact') . ":", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[3], ['gridSpan' => 2])->addText(trans('resume.family_emergencyContactName') . ":", $o_resume['family_emergencyContactName'], $textStyle['zh_tw'], 'pStyle');
            $row->addCell($cm[4], ['gridSpan' => 3])->addText(trans('resume.family_emergencyContactPhone') . ":", $o_resume['family_emergencyContactPhone'], $textStyle['zh_tw'], 'pStyle');
            $row->addCell($cm[4], ['gridSpan' => 3])->addText(trans('resume.family_emergencyContactRelation') . ":", $o_resume['family_emergencyContactRelation'], $textStyle['zh_tw'], 'pStyle');
        }

        if (true) { // 6.推薦人
            $tableName6 = trans('resume.title_recommend');
            $phpWord->addTableStyle($tableName6, $tableStyle['base']);
            $table6 = $section->addTable($tableName6);

            $row = $table6->addRow();
            $row->addCell(11000, ['gridSpan' => 8, 'vMerge' => 'restart', 'bgcolor' => $color['blue']])->addText($tableName6, $header[1]);

            $row = $table6->addRow();

            $row->addCell($cm[1], $cellStyle['title'])->addText("", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[3], $cellStyle['title'])->addText(trans('resume.recommend_name'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[3], $cellStyle['title'])->addText(trans('resume.recommend_phone'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[2], $cellStyle['title'])->addText(trans('resume.recommend_relation'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['title'])->addText("", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[3], $cellStyle['title'])->addText(trans('resume.recommend_name'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[3], $cellStyle['title'])->addText(trans('resume.recommend_phone'), $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[2], $cellStyle['title'])->addText(trans('resume.recommend_relation'), $textStyle['title_zh_tw'], 'pStyle');

            $row = $table6->addRow();
            $row->addCell($cm[1], $textStyle['en_us'])->addText("1", $textStyle['en_us'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($o_resume['recommend_name'], $textStyle['zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($o_resume['recommend_phone'], $textStyle['en_us'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($o_resume['recommend_relation'], $textStyle['zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText("2", $textStyle['en_us'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($o_resume['recommend_name_2'], $textStyle['zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($o_resume['recommend_phone_2'], $textStyle['en_us'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($o_resume['recommend_relation_2'], $textStyle['zh_tw'], 'pStyle');
        }

        if (true) { // 7.其他個人狀況
            $tableName7 = trans('resume.title_other');
            $phpWord->addTableStyle($tableName7, $tableStyle['base']);
            $table7 = $section->addTable($tableName7);

            $row = $table7->addRow();
            $row->addCell(11000, ['gridSpan' => 4, 'vMerge' => 'restart', 'bgcolor' => $color['blue']])->addText($tableName7, $header[1]);

            $row = $table7->addRow();
            $row->addCell($cm[3], $cellStyle['title'])->addText(trans('resume.other_pregnancy'), $textStyle['title_zh_tw']);
            $row->addCell($cm[6], $cellStyle['na'])->addText($this->menu['other_pregnancy'][$o_resume['other_pregnancy']], $textStyle['zh_tw']);
            $row->addCell($cm[4], $cellStyle['title'])->addText(trans('resume.other_hospitalized'), $textStyle['title_zh_tw']);
            $row->addCell($cm[6], $cellStyle['na'])->addText($this->menu['other_hospitalized'][$o_resume['other_hospitalized']] . ' ' . $o_resume['other_hospitalizedReason'], $textStyle['zh_tw']);

            $row = $table7->addRow();
            $row->addCell($cm[1], $cellStyle['title'])->addText(trans('resume.other_law'), $textStyle['title_zh_tw']);
            $row->addCell($cm[1], $cellStyle['na'])->addText($this->menu['other_law'][$o_resume['other_law']] . ' ' . $o_resume['other_lawReason'], $textStyle['zh_tw']);
            $row->addCell($cm[1], $cellStyle['title'])->addText(trans('resume.other_bank'), $textStyle['title_zh_tw']);
            $row->addCell($cm[1], $cellStyle['na'])->addText($this->menu['other_bank'][$o_resume['other_bank']] . ' ' . $o_resume['other_bankReason'], $textStyle['zh_tw']);

            $row = $table7->addRow();
            $row->addCell($cm[1], $cellStyle['title'])->addText(trans('resume.other_workOvertime'), $textStyle['title_zh_tw']);
            $row->addCell($cm[1], $cellStyle['na'])->addText($this->menu['other_workOvertime'][$o_resume['other_workOvertime']] . ' ' . $o_resume['other_workOvertimeMemo'], $textStyle['zh_tw']);
            $row->addCell($cm[1], $cellStyle['title'])->addText(trans('resume.other_workOvertimeHoliday'), $textStyle['title_zh_tw']);
            $row->addCell($cm[1], $cellStyle['na'])->addText($this->menu['other_workOvertimeHoliday'][$o_resume['other_workOvertimeHoliday']] . ' ' . $o_resume['other_workOvertimeHolidayMemo'], $textStyle['zh_tw']);

            $row = $table7->addRow();
            $row->addCell($cm[1], $cellStyle['title'])->addText(trans('resume.other_infoSource'), $textStyle['title_zh_tw']);
            $row->addCell($cm[17], ['gridSpan' => 3])->addText($this->menu['other_infoSource'][$o_resume['other_infoSource']],  $textStyle['zh_tw']);

            $row = $table7->addRow();
            $row->addCell($cm[18], ['gridSpan' => 4, 'bgcolor' => 'F2F2F2'])->addText(trans('resume.other_future'), $textStyle['title_zh_tw'], 'pStyle');

            $row = $table7->addRow();
            $row->addCell($cm[18], ['gridSpan' => 4])->addText($o_resume['other_future'], $textStyle['zh_tw']);
        }

        $section->addPageBreak(); // 換頁

        if (true) { // 3.工作經歷(請由最近一份工作填寫)
            $tableName3 = trans('resume.title_exp') . trans('resume.title_exp_memo');
            $phpWord->addTableStyle($tableName3, $tableStyle['base']);
            $table3 = $section->addTable($tableName3);
            $row = $table3->addRow();
            $row->addCell(11000, ['gridSpan' => 4, 'vMerge' => 'restart', 'bgcolor' => $color['blue']])->addText($tableName3, $header[1]);
            foreach ($o_resume->resume_exp as $i => $exp) {
                // 按換行符號轉陣列
                $a_exp_content = explode("\r\n", $exp['exp_content']);
                $overStrRows = $this->countOverStrToRows($a_exp_content, $a_set['exp_content_one_row_max']);
                $a_set['exp_content_count_rows'] += $a_set['exp_content_base_rows'] + $overStrRows + count($a_exp_content);
                // 行數超過Ｎ, 換頁
                if ($a_set['exp_content_count_rows'] > $a_set['exp_content_one_page_max']) {
                    $section->addPageBreak(); // 換頁
                    $a_set['exp_content_count_rows'] = $a_set['exp_content_base_rows'] + $overStrRows + count($a_exp_content); // 重新定位
                    $tableName3 = trans('resume.title_exp');
                    $phpWord->addTableStyle($tableName3, $tableStyle['base']);
                    $table3 = $section->addTable($tableName3);
                    $row = $table3->addRow();
                    $row->addCell(11000, ['gridSpan' => 4, 'vMerge' => 'restart', 'bgcolor' => $color['blue']])->addText($tableName3, $header[1]);
                }
                $row = $table3->addRow();
                $row->addCell($cm[1], ['vMerge' => 'restart', 'valign' => 'center'])->addText($i + 1, $textStyle['en_us'], 'pStyle');
                $row->addCell($cm[8], $cellStyle['title'])->addText($exp['exp_companyName'] . " " . $exp['exp_companyDepartment'] . " " . $exp['exp_jobTitle'], $textStyle['zh_tw']);
                $row->addCell($cm[5], $cellStyle['title'])->addText(trans('resume.exp_workPlace') . ":" . $exp['exp_workPlace'], $textStyle['zh_tw']);
                $row->addCell($cm[3], $cellStyle['title'])->addText(trans('resume.exp_salary') . ":" . $exp['exp_salary'] . "元", $textStyle['zh_tw']);

                $row = $table3->addRow();
                $row->addCell($cm[1], $cellRowContinue);
                $row->addCell($cm[1], $cellStyle['title'])->addText(trans('resume.exp_startDate') . ":" . $this->dateFormatRepublicOfChinaType2($exp['exp_startDate']) . '-' . $this->dateFormatRepublicOfChinaType2($exp['exp_endDate']), $textStyle['zh_tw']);
                $row->addCell($cm[1], ['gridSpan' => 2, 'bgcolor' => 'F2F2F2'])->addText(trans('resume.exp_leaveReson') . ":" . $exp['exp_leaveReason'], $textStyle['zh_tw']);

                $row = $table3->addRow();
                $row->addCell($cm[1], $cellRowContinue);
                $row->addCell($cm[1], ['gridSpan' => 3])->addText($this->htmlFormatToWord($exp['exp_content']), $textStyle['zh_tw']);
            }
        }

        if (true) { // export
            $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
            try {
                $objWriter->save(storage_path('./app/export/' . $a_set['fileName'] . '_' . Carbon::now()->format("Y-m-d") . '.docx'));
            } catch (Exception $e) {
                //
            }
            return response()->download(storage_path('./app/export/' . $a_set['fileName'] . '_' . Carbon::now()->format("Y-m-d") . '.docx'));
        }
    }

    /**
     * 轉換日期格式 民國年月日
     * ex: 100年01月01日
     * 
     * @param string $date
     * @return string
     */
    public function dateFormatRepublicOfChinaType1($date)
    {
        return (!empty($date) ? ltrim((new DateTime($date))->modify("-1911 year")->format('Y年m月d日'), 0) : '');
    }

    /**
     * 轉換日期格式 民國年月
     * ex: 100/01
     * 
     * @param string $date
     * @return string
     */
    public function dateFormatRepublicOfChinaType2($date)
    {
        return (!empty($date) ? ltrim((new DateTime($date))->modify("-1911 year")->format('Y/m'), 0) : '');
    }

    /**
     * 轉換HTML為Word格式
     * ex: \r\n to 換行
     * @param string
     * @return string
     */
    public function htmlFormatToWord($string)
    {
        return (!empty($string) ? str_replace("\r\n", "<w:br/>", $string) : '');
    }

    /**
     * 計算字串是否超過指定字元的長度, 累積超過的次數
     * ex: 1
     * @param array $arr
     * @param integer $max
     * @param integer $count
     * @return integer
     */
    public function countOverStrToRows($arr, $max, $count = 0)
    {
        foreach ($arr as $row) {
            $count += floor(strlen($row) / $max);
        }
        return intval($count);
    }

    /**
     * 轉換 table的寬度單位
     * 
     * @param integer $width
     * @param integer $base
     * @return integer
     */
    public function countTableWidth($width, $base = 56.692913386)
    {
        return $width * $base * 10;
    }
}
