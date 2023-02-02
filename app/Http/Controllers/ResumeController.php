<?php

namespace App\Http\Controllers;

use App\Resume;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;


class ResumeController extends Controller
{
    /**
     * 驗證規則
     */
    public $rules = [
        //TODO: 驗證規則
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 排序
        $order_by = isset($request->order_by) ? $request->order_by : 'id';
        $sort_by = isset($request->sort_by) ? $request->sort_by : 'desc';
        // 查詢
        $query = Resume::query()->orderBy($order_by, $sort_by);
        $query = $query->simplePaginate(15);
        // 篩選
        $filters = [
            'table_search' => $request->table_search,
        ];
        // 綁定
        $binding = [
            'list' => $query,
            'filters' => $filters,
            'order_by' => $order_by,
            'sort_by' => $sort_by,
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
            'uuid' => Str::uuid(),
            'name' => $request->name,
            'phone' => $request->phone,
            'user_id' => Auth::user()->id,
            'status' => 1,
            'education' => json_encode([]),
            'exp' => json_encode([]),
            'family' => json_encode([]),
            'content' => json_encode([]),
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
        $query = $resume->where(['id' => $id])->first();
        $binding = [
            'query' => $query,
            'education' => json_decode($query->education, true),
            'exp' => json_decode($query->exp, true),
            'family' => json_decode($query->family, true),
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
        $this->saveData($query);
        return redirect()->back()->withInput();
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
        $query = $resume->where(['uuid' => $uuid, 'status' => 1])->firstOrFail();
        $binding = [
            'query' => $query,
            'education' => json_decode($query->education, true),
            'exp' => json_decode($query->exp, true),
            'family' => json_decode($query->family, true),
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
        $query = $resume->where(['uuid' => $uuid, 'status' => 1])->firstOrFail();
        $this->saveData($query);
        return redirect('public/resumes/' . $uuid . '/edit');
    }

    /**
     * Save data
     * 
     * @param  $query
     * @return boolean
     */
    public function saveData($query)
    {
        $query->interview_department = Input::get('interview_department');
        $query->interview_jobTitle = Input::get('interview_jobTitle');
        $query->interview_workDate = Input::get('interview_workDate');
        $query->interview_salary = Input::get('interview_salary');
        $query->interview_lowSalary = Input::get('interview_lowSalary');
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
        $query->info_military = Input::get('info_military');
        $query->info_militaryDate = Input::get('info_militaryDate');
        $query->info_email = Input::get('info_email');
        $query->info_phone = Input::get('info_phone');
        $query->info_address = Input::get('info_address');
        $query->info_telephone = Input::get('info_telephone');
        $query->info_address_2 = Input::get('info_address_2');
        $query->info_telephone_2 = Input::get('info_telephone_2');
        $query->feature_strength = Input::get('feature_strength');
        $query->feature_weakness = Input::get('feature_strength');
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
        $query->other_hospitalized = Input::get('other_hospitalized');
        $query->other_hospitalizedReson = Input::get('other_hospitalizedReson');
        $query->other_law = Input::get('other_law');
        $query->other_lawReson = Input::get('other_lawReson');
        $query->other_infoSource = Input::get('other_infoSource');
        $query->other_infoSourceMemo = Input::get('other_infoSourceMemo');
        $query->other_workOvertime = Input::get('other_workOvertime');
        $query->other_workOvertimeMemo = Input::get('other_workOvertimeMemo');
        $query->other_workOvertimeHoliday = Input::get('other_workOvertimeHoliday');
        $query->other_workOvertimeHolidayMemo = Input::get('other_workOvertimeHolidayMemo');
        $query->other_future = Input::get('other_future');
        $query->education = json_encode(Input::get('education', []));
        $query->exp = json_encode(Input::get('exp', []));
        $query->family = json_encode(Input::get('family', []));
        return $query->save();
    }
}
