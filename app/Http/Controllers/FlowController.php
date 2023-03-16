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
     * 簽核狀態
     */
    public $menu = [
        '' => '-',
        '1'  => '待簽',
        '4'  => '完成',
        '16' => '駁回',
        '64' => '取消',
    ];

    /**
     * 更新簽核狀態
     */
    public $update_status = [4, 16, 64];
    /**
     * 排序
     */
    public $order_list = [
        'itec_task.id',
        'status',
        'title_name',
        'name',
    ];

    /**
     * 待簽核
     */
    public $stepuser_list = ['-1'];

    /**
     * 預設值
     */
    public $default_row_per_page = 50;
    public $min_row_per_page = 10;
    public $max_row_per_page = 100;
    public $default_status = 1;

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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tasks = ItecTask::join('itec_user', 'itec_user.id', 'itec_task.create_user')
            ->join('itec_forminfo', 'itec_forminfo.id', 'itec_task.form_id')
            ->select('itec_task.*', 'itec_user.name', 'itec_user.employee_id', 'itec_forminfo.title_name');

        // 搜尋
        if (!empty($request->q_id)) {
            $tasks->where('itec_task.id', $request->q_id);
        }
        if (!empty($request->q_title)) {
            $tasks->where('title_name', 'like', '%' . $request->q_title . '%');
        }
        if (!empty($request->q_name)) {
            $tasks->where('name', 'like', '%' . $request->q_name . '%');
        }
        // if (!empty($request->q_stepname)) {
        //     $tasks->where('flow_stepname', 'like', '%' . $request->q_stepname . '%');
        // }
        if (!empty($request->q_stepuser)) {
            $stepusers = ItecUser::where('name', 'like', '%' . $request->q_stepuser . '%')->get();
            foreach ($stepusers as $step) {
                $this->stepuser_list[] = $step['id'] . ',';
            }
            $tasks->whereIn('flow_UnSignForView', $this->stepuser_list);
        }
        if (!empty($request->q_status)) {
            $tasks->where('status', $request->q_status);
        }
        // 排序及分頁
        $order_by = isset($request->order_by) && in_array($request->order_by, $this->order_list) ? $request->order_by  : 'itec_task.id';
        $sort_by = isset($request->sort_by) && $request->sort_by == 'asc' ? 'asc' : 'desc';
        $row_per_page = isset($request->row_per_page) && ($request->row_per_page >= $this->min_row_per_page && $this->max_row_per_page >= $request->row_per_page) ? $request->row_per_page : $this->default_row_per_page;
        // 查詢結束
        $flows = $tasks->orderBy($order_by, $sort_by)->simplePaginate($row_per_page);

        // dd($flows);
        // 使用者清單
        $users = ItecUser::all()->keyBy('id');
        $employees = ItecUser::whereNull('leave_office_date')
            ->orderBy('name', 'asc')
            ->get()
            ->keyBy('id');
        // 處理關卡待簽人, 關卡狀態名稱
        foreach ($flows as $flow) {
            $a_sign_list = explode(',', substr($flow['flow_UnSignForView'], 0, -1));
            $flow['flow_sign_name'] = $a_sign_list[count($a_sign_list) - 1] != 0 ? $users[$a_sign_list[count($a_sign_list) - 1]]['name'] : '';
            $flow['status_name'] = $this->menu[$flow['status']];
            $flow['create_date_format'] = date('Y-m-d H:i', strtotime($flow['create_date']));
            $flow['update_date_format'] = date('Y-m-d H:i', strtotime($flow['update_date']));
            $flow['flow_stepname_link'] = env('IOA_URL') . env('IOA_FLOW_DESIGN_PATH') . '?id=' . $flow['form_id'];
        }
        // dd($flows);
        // 儲存篩選結果
        $filters = [
            'q_id' => $request->q_id,
            'q_title' => $request->q_title,
            'q_name' => $request->q_name,
            'q_status' => $request->q_status,
            'q_stepuser' => $request->q_stepuser,
        ];

        $binding = [
            'list' => $flows,
            'menu' => $this->menu,
            'filters' => $filters,
            'order_by' => $order_by,
            'sort_by' => $sort_by,
            'row_per_page' => $row_per_page,
            'employees' => $employees,
        ];

        return view('pages.flow_list', $binding);
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
     * 
     * @param string $id
     * @param string $step_id
     * @param string $step_user_id
     * @param string $status
     * 
     * @return  Array
     */
    public function flowUpdate()
    {
        $input = Input::all();
        $rules = [
            'id' => ['required']
        ];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return [
                'success' => false,
                'message' => $validator,
                'code' => null,
                'data' => null,
            ];
        }
        // 查單據
        $task = ItecTask::find($input['id']);
        if ($task == null) {
            return [
                'success' => false,
                'message' => 'id not found',
                'code' => null,
                'data' => null,
            ];
        }
        if ($input['status'] == '' && $input['step_id'] == '' && $input['step_user_id'] == '') {
            return [
                'success' => false,
                'message' => 'input error',
                'code' => null,
                'data' => null,
            ];
        }
        // 簽核狀態 更新
        if ($input['status'] && in_array($input['status'], $this->update_status)) {
            $task->status = $input['status'];
            $task->flow_BeSign = $task->flow_UnSign = $task->flow_UnSignForView = '';
        }
        // 簽核關卡名稱 簽核關卡id 更新
        if ($input['step_id']) {
            $flow_step = array_column($this->flowStep($input['id']), 'name', 'id');
            $collection = collect($flow_step);
            $step_name = $collection->get($input['step_id']);
            if ($step_name) {
                $task->flow_stepid = $input['step_id'];
                $task->flow_stepname = $step_name;
            }
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
        $task->save();

        return [
            'success' => true,
            'message' => 'successfully',
            'code' => 200,
            'data' => $task,
        ];
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
            ->where('itec_task.update_date', '>=',$startDateTime)
            ->where('itec_task.update_date', '<=',$endDateTime)
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
