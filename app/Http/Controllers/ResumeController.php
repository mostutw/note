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
        // 
        'school_level' => [
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
            '' => '-',
        ],
        // 就學狀況
        'school_status' => [
            '1' => '畢業',
            '2' => '肄業',
            '3' => '就學',
            '' => '-',
        ],
        // 填寫狀況
        'resume_status' => [
            '1' => '進行中',
            '2' => '已完成',
            '3' => '已取消',
        ],
        // 外部連關閉/上鎖
        'resume_lock' => [
            '0' => '開放中',
            '1' => '已關閉',
        ],
        // 性別
        'info_sex' => [
            '1' => '男',
            '2' => '女',
            '' => '-',
        ],
        // 婚姻
        'info_marry' => [
            '1' => '單身',
            '2' => '已婚',
            '' => '-',
        ],
        // 辨色
        'info_colorPerception' => [
            '1' => '正常',
            '2' => '色盲',
            '' => '-',
        ],
        // 身障
        'info_disability' => [
            '1' => '是',
            '2' => '否',
            '' => '-',
        ],
        // 兵役
        'info_military' => [
            '1' => '役畢',
            '2' => '免役',
            '3' => '代役',
            '' => '-',
        ],
        // 英文
        'feature_englishLevel' => [
            '1' => '精通',
            '2' => '中等',
            '3' => '略懂',
            '4' => '不懂',
            '' => '-',
        ],
        // 台語
        'feature_taiwaneseHokkienLevel' => [
            '1' => '精通',
            '2' => '中等',
            '3' => '略懂',
            '4' => '不懂',
            '' => '-',
        ],
        // 有無懷孕
        'other_pregnancy' => [
            '1' => '無',
            '2' => '有',
            '' => '-',
        ],
        // 住院/開刀記錄
        'other_hospitalized' => [
            '1' => '無',
            '2' => '有',
            '' => '-',
        ],
        // 刑事/民事記錄
        'other_law' => [
            '1' => '無',
            '2' => '有',
            '' => '-',
        ],
        // 曾有不良債信記錄
        'other_bank' => [
            '1' => '無',
            '2' => '有',
            '' => '-',
        ],
        // 平日加班
        'other_workOvertime' => [
            '1' => '可',
            '2' => '否',
            '' => '-',
        ],
        // 例假日加班
        'other_workOvertimeHoliday' => [
            '1' => '可',
            '2' => '否',
            '' => '-',
        ],
        // 求職資訊
        'other_infoSource' => [
            '1' => '員工推薦',
            '2' => '其他來源',
            '' => '-',
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
        $request->validate(['name' => 'required', 'phone' => 'nullable|numeric']);
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
        return $return == true ? redirect()->back()->with('success', 'Profile updated!') : redirect()->back()->with('fail', 'Error!');
        // return redirect()->back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resume $resume)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function editForPublic($uuid, Resume $resume)
    {
        $query = $resume->where(['uuid' => $uuid, 'lock' => 0])->firstOrFail();
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
     * Save data
     * 
     * @param  $query
     * @return boolean
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
                    'exp_content' => $value['exp_content'],
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
        ];
        
        if (true) { // 頁首
            $headerText = $section->addHeader();
            $table = $headerText->addTable();
            $table->addRow();
            $table->addCell($cm[9])->addImage($a_set['logo'], ['width' => '245', 'height' => '50']);
            $table->addCell($cm[3])->addText('');
            $table->addCell($cm[5])->addText('人事資料表', $header[0], ['spaceBefore' => 250]);
            $table = $headerText->addTable();
            $table->addRow();
            $table->addCell($cm[7])->addText('限閱:求職者暨權責單位', $textStyle['zh_tw']);
            $table->addCell($cm[7])->addText('機密等級:敏感機密', $textStyle['zh_tw']);
            $table->addCell($cm[1])->addText('編號:', $textStyle['zh_tw']);
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
            $table->addCell($cm[4], $cellStyle['title'])->addText("應徵部門", $textStyle['title_zh_tw'], 'pStyle');
            $table->addCell($cm[4], $cellStyle['na'])->addText($o_resume['interview_department'], $textStyle['zh_tw']);
            $table->addCell($cm[4], $cellStyle['title'])->addText("應徵職務", $textStyle['title_zh_tw'], 'pStyle');
            $table->addCell($cm[4], $cellStyle['na'])->addText($o_resume['interview_jobTitle'], $textStyle['zh_tw']);
            $table->addCell($cm[4], $cellStyle['title'])->addText("填表日期", $textStyle['title_zh_tw'], 'pStyle');
            $table->addCell($cm[4], $cellStyle['na'])->addText($a_set['interview_applyDate'], $textStyle['zh_tw']);
            
            $table->addRow();
            $table->addCell($cm[4], $cellStyle['title'])->addText("期望待遇", $textStyle['title_zh_tw'], 'pStyle');
            $table->addCell($cm[4], $cellStyle['na'])->addText($o_resume['interview_salary'], $textStyle['zh_tw']);
            $table->addCell($cm[4], $cellStyle['title'])->addText("最低可接受月薪", $textStyle['title_zh_tw'], 'pStyle');
            $table->addCell($cm[4], $cellStyle['na'])->addText($o_resume['interview_lowSalary'], $textStyle['zh_tw']);
            $table->addCell($cm[4], $cellStyle['title'])->addText("最快上班日", $textStyle['title_zh_tw'], 'pStyle');
            $table->addCell($cm[4], $cellStyle['na'])->addText($a_set['interview_workDate'], $textStyle['zh_tw']);
        }

        if (true) { // 1.個人基本資料
            $tableName1 = '個人基本資料';
            $phpWord->addTableStyle($tableName1, $tableStyle['base']);
            $table1 = $section->addTable($tableName1);

            $row = $table1->addRow();
            $row->addCell(11000, ['gridSpan' => 7, 'vMerge' => 'restart', 'bgcolor' => $color['blue']])->addText($tableName1, $header[1]);

            $row = $table1->addRow();
            $row->addCell($cm[3], $cellStyle['title'])->addText("中文姓名", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[3], $cellStyle['na'])->addText($o_resume['info_chineseName'], $textStyle['zh_tw']);
            $row->addCell($cm[3], $cellStyle['title'])->addText("英文姓名", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[4], $cellStyle['na'])->addText($o_resume['info_englishName'], $textStyle['en_us']);
            $row->addCell($cm[3], $cellStyle['title'])->addText("性別", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[3], $cellStyle['na'])->addText($a_set['info_sex'], $textStyle['zh_tw']);
            $row->addCell($cm[4], ['vMerge' => 'restart', 'valign' => 'center'])->addText('一吋照片', $textStyle['zh_tw'], 'pStyle');

            $row = $table1->addRow();
            $row->addCell($cm[1], $cellStyle['title'])->addText("身份證號", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($o_resume['info_id'], $textStyle['en_us']);
            $row->addCell($cm[1], $cellStyle['title'])->addText("出生日期", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($a_set['info_birthday'], $textStyle['zh_tw']);
            $row->addCell($cm[1], $cellStyle['title'])->addText("婚姻", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($a_set['info_marry'], $textStyle['zh_tw']);
            $row->addCell($cm[1], $cellRowContinue);

            $row = $table1->addRow();
            $row->addCell($cm[1], $cellStyle['title'])->addText("籍貫", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($o_resume['info_birthplace'], $textStyle['zh_tw']);
            $row->addCell($cm[1], $cellStyle['title'])->addText("辨色力", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($a_set['info_colorPerception'], $textStyle['zh_tw']);
            $row->addCell($cm[1], $cellStyle['title'])->addText("視力", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText("左:" . $o_resume['info_visionLeft'] . " 右:" . $o_resume['info_visionRight'], $textStyle['zh_tw']);
            $row->addCell($cm[1], $cellRowContinue);

            $row = $table1->addRow();
            $row->addCell($cm[1], $cellStyle['title'])->addText("血型", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($o_resume['info_blood'], $textStyle['en_us']);
            $row->addCell($cm[1], $cellStyle['title'])->addText("身高", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($o_resume['info_height'] . "公分", $textStyle['zh_tw']);
            $row->addCell($cm[1], $cellStyle['title'])->addText("體重", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($o_resume['info_weight'] . "公斤", $textStyle['zh_tw']);
            $row->addCell($cm[1], $cellRowContinue);

            $row = $table1->addRow();
            $row->addCell($cm[1], $cellStyle['title'])->addText("身心障礙", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($a_set['info_disability'], $textStyle['zh_tw']);
            $row->addCell($cm[1], $cellStyle['title'])->addText("類別", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($o_resume['info_disabilityType'], $textStyle['zh_tw']);
            $row->addCell($cm[1], $cellStyle['title'])->addText("程度", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($o_resume['info_disabilityLevel'], $textStyle['zh_tw']);
            $row->addCell($cm[1], $cellRowContinue);

            $row = $table1->addRow();
            $row->addCell($cm[1], $cellStyle['title'])->addText("E-Mail", $textStyle['title_en_us'], 'pStyle');
            $row->addCell($cm[1], ['gridSpan' => 3])->addText($o_resume['info_email'], $textStyle['en_us']);
            $row->addCell($cm[1], $cellStyle['title'])->addText("手機", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($o_resume['info_phone'], $textStyle['en_us']);
            $row->addCell($cm[1], $cellRowContinue);

            $row = $table1->addRow();
            $row->addCell($cm[1], $cellStyle['title'])->addText("戶籍地址", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], ['gridSpan' => 3])->addText($o_resume['info_address'], $textStyle['zh_tw']);
            $row->addCell($cm[1], $cellStyle['title'])->addText("電話(H)", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($o_resume['info_telephone'], $textStyle['en_us']);
            $row->addCell($cm[1], $cellRowContinue);

            $row = $table1->addRow();
            $row->addCell($cm[1], $cellStyle['title'])->addText("通訊地址", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], ['gridSpan' => 3])->addText($o_resume['info_address_2'], $textStyle['zh_tw']);
            $row->addCell($cm[1], $cellStyle['title'])->addText("電話(H)", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($o_resume['info_telephone_2'], $textStyle['en_us']);
            $row->addCell($cm[1], $cellRowContinue);

            $row = $table1->addRow();
            $row->addCell($cm[1], $cellStyle['title'])->addText("兵役", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], ['gridSpan' => 3])->addText($a_set['info_military'], $textStyle['zh_tw']);
            $row->addCell($cm[1], $cellStyle['title'])->addText("免役原因", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], ['gridSpan' => 2])->addText("", $textStyle['zh_tw']);
        }

        if (true) { // 2.教育背景
            $tableName2 = '教育背景/專業課程';
            $phpWord->addTableStyle($tableName2, $tableStyle['base']);
            $table2 = $section->addTable($tableName2);

            $row = $table2->addRow();
            $row->addCell(11000, ['gridSpan' => 5,  'vMerge' => 'restart',  'bgcolor' => $color['blue']])->addText($tableName2, $header[1]);

            $row = $table2->addRow();
            $row->addCell($cm[3], $cellStyle['title'])->addText("學位", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[4], $cellStyle['title'])->addText("學校", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[4], $cellStyle['title'])->addText("科系", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[4], $cellStyle['title'])->addText("起訖時間", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[5], $cellStyle['title'])->addText("就學狀態", $textStyle['title_zh_tw'], 'pStyle');

            // dd($a_set['resume_education']);
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
                $row->addCell($cm[1], $cellStyle['title'])->addText('專業課程', $textStyle['title_zh_tw'], 'pStyle');
                $row->addCell($cm[1], $cellStyle['na'])->addText($course['course_name'], $textStyle['zh_tw']);
                $row->addCell($cm[1], $cellStyle['na'])->addText($course['course_department'], $textStyle['zh_tw']);
                $row->addCell($cm[1], $cellStyle['na'])->addText($this->dateFormatRepublicOfChinaType2($course['course_startDate']) . ' - ' . $this->dateFormatRepublicOfChinaType2($course['course_endDate']), $textStyle['en_us'], 'pStyle');
                $row->addCell($cm[1], $cellStyle['na'])->addText('-', $textStyle['zh_tw'], 'pStyle');
            }

            $row = $table2->addRow();
            $row->addCell($cm[1], $cellStyle['title'])->addText("畢業論文題目", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], ['gridSpan' => 4])->addText($a_set['resume_education_school_thesisTopic'], $textStyle['zh_tw']);
        }

        if (true) { // 4.個人特質/專業能力
            $tableName4 = '個人特質/專業能力';
            $phpWord->addTableStyle($tableName4, $tableStyle['base']);
            $table4 = $section->addTable($tableName4);

            $row = $table4->addRow();
            $row->addCell(11000, ['gridSpan' => 4, 'vMerge' => 'restart', 'bgcolor' => $color['blue']])->addText($tableName4, $header[1]);

            $row = $table4->addRow();
            $row->addCell($cm[2], $cellStyle['title'])->addText("優點", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[6], $cellStyle['na'])->addText($o_resume['feature_strength'], $textStyle['zh_tw']);
            $row->addCell($cm[2], $cellStyle['title'])->addText("缺點", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[6], $cellStyle['na'])->addText($o_resume['feature_weakness'], $textStyle['zh_tw']);

            $row = $table4->addRow();
            $row->addCell($cm[1], $cellStyle['title'])->addText("語言", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText("英語" . ":" . $this->menu['feature_englishLevel'][$o_resume['feature_englishLevel']] . ' ' . "台語" . ":" .  $this->menu['feature_taiwaneseHokkienLevel'][$o_resume['feature_taiwaneseHokkienLevel']], $textStyle['zh_tw']);
            $row->addCell($cm[1], $cellStyle['title'])->addText("證照", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['na'])->addText($o_resume['feature_license'], $textStyle['zh_tw']);

            $row = $table4->addRow();
            $row->addCell($cm[1], $cellStyle['title'])->addText("專業技能", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[16], ['gridSpan' => 3])->addText($o_resume['feature_skill'], $textStyle['zh_tw']);
        }

        if (true) { // 5.家庭狀況
            $tableName5 = '家庭狀況';
            $phpWord->addTableStyle($tableName5, $tableStyle['base']);
            $table5 = $section->addTable($tableName5);

            $row = $table5->addRow();
            $row->addCell(11000, ['gridSpan' => 10, 'vMerge' => 'restart', 'bgcolor' => $color['blue']])->addText($tableName5, $header[1]);

            $row = $table5->addRow();
            $row->addCell($cm[1], $cellStyle['title'])->addText("", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[3], $cellStyle['title'])->addText("關係", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[4], $cellStyle['title'])->addText("姓名", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[3], $cellStyle['title'])->addText("年齡", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[4], $cellStyle['title'])->addText("職業", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['title'])->addText("", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[3], $cellStyle['title'])->addText("關係", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[4], $cellStyle['title'])->addText("姓名", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[3], $cellStyle['title'])->addText("年齡", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[4], $cellStyle['title'])->addText("職業", $textStyle['title_zh_tw'], 'pStyle');

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
            $row->addCell($cm[3], ['gridSpan' => 2])->addText("緊急聯絡人", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[3], ['gridSpan' => 2])->addText("姓名:" . $o_resume['family_emergencyContactName'], $textStyle['zh_tw'], 'pStyle');
            $row->addCell($cm[4], ['gridSpan' => 3])->addText("電話:" . $o_resume['family_emergencyContactPhone'], $textStyle['zh_tw'], 'pStyle');
            $row->addCell($cm[4], ['gridSpan' => 3])->addText("關係:" . $o_resume['family_emergencyContactRelation'], $textStyle['zh_tw'], 'pStyle');
        }

        if (true) { // 6.推薦人
            $tableName6 = '推薦人';
            $phpWord->addTableStyle($tableName6, $tableStyle['base']);
            $table6 = $section->addTable($tableName6);

            $row = $table6->addRow();
            $row->addCell(11000, ['gridSpan' => 8, 'vMerge' => 'restart', 'bgcolor' => $color['blue']])->addText($tableName6, $header[1]);

            $row = $table6->addRow();
            $row->addCell($cm[1], $cellStyle['title'])->addText("", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[3], $cellStyle['title'])->addText("姓名", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[3], $cellStyle['title'])->addText("電話", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[2], $cellStyle['title'])->addText("關係", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[1], $cellStyle['title'])->addText("", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[3], $cellStyle['title'])->addText("姓名", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[3], $cellStyle['title'])->addText("電話", $textStyle['title_zh_tw'], 'pStyle');
            $row->addCell($cm[2], $cellStyle['title'])->addText("關係", $textStyle['title_zh_tw'], 'pStyle');

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
            $tableName7 = '其他個人狀況';
            $phpWord->addTableStyle($tableName7, $tableStyle['base']);
            $table7 = $section->addTable($tableName7);

            $row = $table7->addRow();
            $row->addCell(11000, ['gridSpan' => 4, 'vMerge' => 'restart', 'bgcolor' => $color['blue']])->addText($tableName7, $header[1]);

            $row = $table7->addRow();
            $row->addCell($cm[3], $cellStyle['title'])->addText("目前有無懷孕", $textStyle['title_zh_tw']);
            $row->addCell($cm[6], $cellStyle['na'])->addText($this->menu['other_pregnancy'][$o_resume['other_pregnancy']], $textStyle['zh_tw']);
            $row->addCell($cm[4], $cellStyle['title'])->addText("曾有住院/開刀記錄", $textStyle['title_zh_tw']);
            $row->addCell($cm[6], $cellStyle['na'])->addText($this->menu['other_hospitalized'][$o_resume['other_hospitalized']] . ' ' . $o_resume['other_hospitalizedReason'], $textStyle['zh_tw']);

            $row = $table7->addRow();
            $row->addCell($cm[1], $cellStyle['title'])->addText("刑事/民事記錄", $textStyle['title_zh_tw']);
            $row->addCell($cm[1], $cellStyle['na'])->addText($this->menu['other_law'][$o_resume['other_law']] . ' ' . $o_resume['other_lawReason'], $textStyle['zh_tw']);
            $row->addCell($cm[1], $cellStyle['title'])->addText("曾有不良債信記錄", $textStyle['title_zh_tw']);
            $row->addCell($cm[1], $cellStyle['na'])->addText($this->menu['other_bank'][$o_resume['other_bank']] . ' ' . $o_resume['other_bankReason'], $textStyle['zh_tw']);

            $row = $table7->addRow();
            $row->addCell($cm[1], $cellStyle['title'])->addText("平日加班", $textStyle['title_zh_tw']);
            $row->addCell($cm[1], $cellStyle['na'])->addText($this->menu['other_workOvertime'][$o_resume['other_workOvertime']] . ' ' . $o_resume['other_workOvertimeMemo'], $textStyle['zh_tw']);
            $row->addCell($cm[1], $cellStyle['title'])->addText("例假日加班", $textStyle['title_zh_tw']);
            $row->addCell($cm[1], $cellStyle['na'])->addText($this->menu['other_workOvertimeHoliday'][$o_resume['other_workOvertimeHoliday']] . ' ' . $o_resume['other_workOvertimeHolidayMemo'], $textStyle['zh_tw']);

            $row = $table7->addRow();
            $row->addCell($cm[1], $cellStyle['title'])->addText("求職資訊來源", $textStyle['title_zh_tw']);
            $row->addCell($cm[17], ['gridSpan' => 3])->addText($this->menu['other_infoSource'][$o_resume['other_infoSource']],  $textStyle['zh_tw']);

            $row = $table7->addRow();
            $row->addCell($cm[18], ['gridSpan' => 4, 'bgcolor' => 'F2F2F2'])->addText("請具體說明未來個人生涯規劃", $textStyle['title_zh_tw'], 'pStyle');

            $row = $table7->addRow();
            $row->addCell($cm[18], ['gridSpan' => 4])->addText($o_resume['other_future'], $textStyle['zh_tw']);
        }

        $section->addPageBreak(); // 換頁

        if (true) { // 3.工作經歷(請由最近一份工作填寫)
            $tableName3 = '工作經歷(請由最近一份工作填寫)';
            $phpWord->addTableStyle($tableName3, $tableStyle['base']);
            $table3 = $section->addTable($tableName3);
            $row = $table3->addRow();
            $row->addCell(11000, ['gridSpan' => 4, 'vMerge' => 'restart', 'bgcolor' => $color['blue']])->addText($tableName3, $header[1]);
            foreach ($o_resume->resume_exp as $i => $exp) {
                $row = $table3->addRow();
                $row->addCell($cm[1], ['vMerge' => 'restart', 'valign' => 'center'])->addText($i + 1, $textStyle['en_us'], 'pStyle');
                $row->addCell($cm[8], $cellStyle['title'])->addText($exp['exp_companyName'] . " " . $exp['exp_companyDepartment'] . " " . $exp['exp_jobTitle'], $textStyle['zh_tw']);
                $row->addCell($cm[5], $cellStyle['title'])->addText("地點: " . $exp['exp_workPlace'], $textStyle['zh_tw']);
                $row->addCell($cm[3], $cellStyle['title'])->addText("薪資(月薪): " . $exp['exp_salary'] . "元", $textStyle['zh_tw']);

                $row = $table3->addRow();
                $row->addCell($cm[1], $cellRowContinue);
                $row->addCell($cm[1], $cellStyle['title'])->addText("任職期間: " . $this->dateFormatRepublicOfChinaType2($exp['exp_startDate']) . '-' . $this->dateFormatRepublicOfChinaType2($exp['exp_endDate']), $textStyle['zh_tw']);
                $row->addCell($cm[1], ['gridSpan' => 2, 'bgcolor' => 'F2F2F2'])->addText("離職原因: " . $exp['exp_leaveReason'], $textStyle['zh_tw']);

                $row = $table3->addRow();
                $row->addCell($cm[1], $cellRowContinue);
                $row->addCell($cm[1], ['gridSpan' => 3])->addText($exp['exp_content'], $textStyle['zh_tw']);
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
     * @param datetime
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
     * @param datetime
     * @return string
     */
    public function dateFormatRepublicOfChinaType2($date)
    {
        return (!empty($date) ? ltrim((new DateTime($date))->modify("-1911 year")->format('Y/m'), 0) : '');
    }
}
