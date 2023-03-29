<?php

namespace App\Http\Controllers;

use App\ItecTask;
use App\ItecUser;
use App\ItecFormData;
use App\ItecFormInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;

class FlowController extends Controller
{
    /**
     * 下拉式選單
     */
    public $menu = [
        'status' => [
            '' => '-',
            '1'  => '待簽',
            '4'  => '完成',
            '16' => '駁回',
            '64' => '取消',
        ],
        'row_per_page' => [
            10, 25, 50, 100,
        ],
        'update_status' => [
            4, 16, 64,
        ],
    ];

    /**
     * 建構式
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    protected function guard()
    {
        // return Auth::guard('flow');
    }

    /**
     * Display a listing of the resource.
     * 
     * @param \Illuminate\Http\Request  $request
     * @param \App\ItecUser $itecuser
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ItecUser $itecuser)
    {
        $request->validate([
            'q_id' => 'nullable|integer',
            'q_title' => 'nullable|string',
            'q_name' => 'nullable|string',
            'q_stepuser' => 'nullable|string',
            'q_status' => 'nullable|integer|in:1,4,16,64',
            'row_per_page' => 'nullable|integer|between:10,100',
        ]);

        $where = [];
        $filters = [];

        $tasks = ItecTask::join('itec_user', 'itec_user.id', 'itec_task.create_user')
            ->join('itec_forminfo', 'itec_forminfo.id', 'itec_task.form_id')
            ->select('itec_task.*', 'itec_user.name', 'itec_user.employee_id', 'itec_forminfo.title_name');

        if ($request->filled('q_id')) {
            $filters['q_id'] = $request->input('q_id');
            $where[] = ['itec_task.id', $filters['q_id']];
        }

        if ($request->filled('q_title')) {
            $filters['q_title'] = $request->input('q_title');
            $where[] = ['itec_forminfo.title_name', 'like', '%' . $filters['q_title'] . '%'];
        }

        if ($request->filled('q_name')) {
            $filters['q_name'] = $request->input('q_name');
            $where[] = ['itec_user.name', 'like', '%' . $filters['q_name'] . '%'];
        }

        if ($request->filled('q_status')) {
            $filters['q_status'] = $request->input('q_status');
            $where[] = ['itec_task.status', $filters['q_status']];
        }

        if ($request->filled('q_stepuser')) {
            $filters['q_stepuser'] = $request->input('q_stepuser');
            $stepusers = $itecuser->where('name', 'like', '%' . $filters['q_stepuser'] . '%')->get();
            $stepusersWhereIn = collect($stepusers)->map(function ($item) {
                return $item->id . ',';
            });
            $tasks->whereIn('flow_UnSignForView', $stepusersWhereIn);
        }

        $filters['row_per_page'] = $request->input('row_per_page', 50);
        $flows = $tasks->where($where)->orderBy('itec_task.id', 'desc')->simplePaginate($filters['row_per_page']);

        $users = $itecuser->all()->keyBy('id');
        $employees = $itecuser->whereNull('leave_office_date')->orderBy('name', 'asc')->get()->keyBy('id');

        foreach ($flows as $flow) {
            $a_sign_list = explode(',', substr($flow['flow_UnSignForView'], 0, -1));
            $flow['flow_sign_name'] = $a_sign_list[count($a_sign_list) - 1] != 0 ? $users[$a_sign_list[count($a_sign_list) - 1]]['name'] : '';
            $flow['status_name'] = $this->menu['status'][$flow['status']];
            $flow['create_date_format'] = date('Y-m-d H:i', strtotime($flow['create_date']));
            $flow['update_date_format'] = date('Y-m-d H:i', strtotime($flow['update_date']));
            $flow['flow_stepname_link'] = env('IOA_URL') . env('IOA_FLOW_DESIGN_PATH') . '?id=' . $flow['form_id'];
        }

        $binding = [
            'list' => $flows,
            'menu' => $this->menu,
            'filters' => $filters,
            'employees' => $employees,
        ];
        // dd($binding);
        return view('pages.flow_list')->with($binding);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * 取得該表單簽核流程
     * @param   integer  $id
     * @return  array
     */
    public function flowStep($id)
    {
        $flow = ItecTask::join('itec_forminfo', 'itec_forminfo.id', 'itec_task.form_id')
            ->join('itec_flow', 'itec_flow.id', 'itec_forminfo.flow_id')
            ->select('itec_task.flow_stepid', 'itec_task.flow_stepid', 'itec_flow.id', 'itec_flow.flow_name', 'itec_flow.flow_xml')
            ->where('itec_task.id', $id)
            ->get();

        foreach ($flow as $xml) {
            $result = json_decode(json_encode(simplexml_load_string($xml->flow_xml)), true);
        }

        foreach ($result['FlowStructure']['Step'] as $value) {
            $data[] = [
                'id' => $value['ID'],
                'name' => $value['Name'],
                'content_type' => $value['ContentType'],
                'accept_to' => $value['AcceptTo'],
                'reject_to' => $value['RejectTo'],
            ];
        }
        return $data;
    }

    /**
     * 更新該表單簽核流程
     * @param  \Illuminate\Http\Request  $request
     * @param integer $id
     * @param string $step_id
     * @param integer $step_user_id
     * @param integer $status
     * @return boolean
     */
    public function flowUpdate(Request $request, $id)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'id' => 'required|integer',
            'step_id' => 'nullable|string',
            'step_user_id' => 'nullable|string',
            'status' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return json_encode([
                'success' => false,
                'message' => $validator,
            ]);
        }

        $task = ItecTask::findOrFail($input['id']);
        // 簽核狀態 更新
        if ($input['status']) {
            $task->status = $input['status'];
            $task->flow_BeSign = $task->flow_UnSign = $task->flow_UnSignForView = '';
        }
        // 簽核關卡名稱 簽核關卡id 更新
        if ($input['step_id']) {
            $flow_step = array_column($this->flowStep($input['id']), 'name', 'id');
            $step_name = collect($flow_step)->get($input['step_id']);
            $task->flow_stepid = $input['step_id'];
            $task->flow_stepname = $step_name;
        }
        /**
         *  簽核關卡人 更新
         *  1. 查詢原關卡人id
         *  2. 將原關卡人id替換為新關卡人id
         */
        if ($input['step_user_id'] && $input['status'] == '') {
            $task_step_user_id = strlen($task->flow_UnSignForView) > 1 ? substr($task->flow_UnSignForView, 0, strlen($task->flow_UnSignForView) - 1) : '';
            $task->flow_BeSign = $task_step_user_id != '' ? str_replace($task_step_user_id, $input['step_user_id'], $task->flow_BeSign) : $input['step_user_id'] . ',';
            $task->flow_UnSign = $task_step_user_id != '' ? str_replace($task_step_user_id, $input['step_user_id'], $task->flow_UnSign) : $input['step_user_id'] . ',';
            $task->flow_UnSignForView = $input['step_user_id'] . ',';
        }
        // 存檔
        if ($task->save()) {
            // 模型儲存成功的處理
            return json_encode([
                'success' => true,
            ]);
            return json_encode('success');
        } else {
            // 模型儲存失敗的處理
            return json_encode([
                'success' => false,
            ]);
        }
    }
    /**
     * 處理XML內的字串型陣列
     * 
     * @param string $string
     * @return Array
     */
    public function stringToArray($string)
    {
        $string = str_replace(str_split('[]\\/:*?"<>|'), '', $string);
        return explode(',', $string);
    }

    /**
     * 取得近1分鐘Task,並在teams發送通知 
     */

    public function sendMessageByTask()
    {
        $startDate = Carbon::now()->subMinute(3);
        $endDate = Carbon::now()->subMinute(2);
        $startDateTime = substr_replace($startDate->toDateTimeString(), '00', '17');
        $endDateTime = substr_replace($endDate->toDateTimeString(), '00', '17');

        $sign_list = ItecTask::join('itec_user', 'itec_user.id', 'itec_task.create_user')
            ->join('itec_forminfo', 'itec_forminfo.id', 'itec_task.form_id')
            ->select('itec_task.*', 'itec_user.name', 'itec_user.employee_id', 'itec_forminfo.title_name')
            ->where('itec_task.update_date', '>=', $startDateTime)
            ->where('itec_task.update_date', '<=', $endDateTime)
            ->orderBy('itec_task.update_date')
            ->get();

        foreach ($sign_list as $sign) {
            $sign_array = explode(',', substr($sign['flow_UnSignForView'], 0, -1));
            $sign_user_id = $sign_array[count($sign_array) - 1];
            $user_id = $sign['status'] == 1 ? $sign_user_id : $sign['create_user'];
            $user = ItecUser::where('leave_office_date')->where('id', $user_id)->first();

            if ($user) {
                $content = "<a href='" . env('IOA_URL') . "'>" . 'iOA 通知' . "</a><br>";
                $content .= "單號: " . $sign['id'] . "<br>";
                $content .= "表單: " . $sign['title_name'] . "<br>";
                // $content .= "狀態: " . $this->menu[$sign['status']] . "<br>";
                $content .= "填單日: " . $sign['create_date'] . "<br>";
                $content .= "填表人: " . $sign['name'] . "<br>";
                $content .= $sign['status'] == 1 ? "待簽核: " . $user->name . "<br>" : '';
                $content .= "-------此為系統自動通知信-------" . "<br>";

                $client = new \GuzzleHttp\Client();

                $response = $client->request('POST', env('ITEC_API_URL') . '/api/chat/send', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . env('ITEC_API_TOKEN'),
                        'Accept' => 'application/json',
                    ],
                    'form_params' => [
                        'from' => env('APP_NAME'),
                        'to' => $user->email,
                        'content' => $content,
                    ],
                ]);
            }
        }
    }
}
