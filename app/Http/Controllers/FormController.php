<?php

namespace App\Http\Controllers;

use App\ItecFormData;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class FormController extends Controller
{
    /**
     * 選單
     */
    public $menu = [
        'sResult' => [
            '0' => '填單',
            '1' => '同意',
            '2' => '駁回',
            '3' => '徵詢其他簽核人意見',
            '4' => '駁回指定關卡',
            '5' => '回覆',
        ],
    ];

    /**
     * 欄位儲存類型
     * 
     * @return array
     */
    public $field_type = [
        'upload', 'editor'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  integer $id
     * @param  array $masterForm
     * @param  array $slaveForm
     * @return \Illuminate\Http\Response
     */
    public function show($id, $masterForm = [], $slaveForm = [])
    {
        // 取得 form data
        $itecFormData = ItecFormData::with('user')->where('task_id', $id)->orderBy('version')->get();
        // 取得 form data 最後一版
        $itecFormDataLast = $itecFormData->last();
        // 將 form_xml 轉換為陣列
        $form_xml = $this->xmlToArray($itecFormDataLast->form_info->form_xml);
        // 將 form_content 轉換為陣列
        $form_content = $this->xmlToArray($itecFormDataLast->form_content);
        // formTemplate with items
        $items = collect($form_xml['FormStructure']['item'])->keyBy('ID')->toArray();
        $formTemplate = $form_content['FormTemplate'];
        // 主表
        foreach ($formTemplate as $key => $value) {
            $newKey = str_replace($itecFormDataLast->form_info->simple_code . '_', '', $key);
            if (array_key_exists($newKey, $items)) {
                $items[$newKey]['value'] = !empty($value) ? (string) $value : '';
                $items[$newKey]['value'] = in_array($items[$newKey]['Type'], $this->field_type) ? $this->field_process($items[$newKey]['value'], $items[$newKey]['Type']) : $items[$newKey]['value'];
                $items[$newKey]['view'] = !isset($items[$newKey]['Sum']) ? true : false;
                $items[$newKey]['redtext'] = isset($items[$newKey]['Redtext']) && $items[$newKey]['Redtext'] == 'true' ? true : false;
                $masterForm[] = $items[$newKey];
            }
        }
        // 子表
        if (isset($formTemplate[$itecFormDataLast->form_info->simple_code . '_' . 'DynamicFields'])) {
            $formTableDynamicFields = json_decode($formTemplate[$itecFormDataLast->form_info->simple_code . '_' . 'DynamicFields'], true);
            // 子表的資料
            foreach ($formTableDynamicFields as $value) {
                if (array_key_exists($value['Code'], $items)) {
                    $slaveForm[$value['Code']]['data'][] = $value['Data'];
                }
            }
            foreach ($items as $key => $value) {
                if (array_key_exists($key, $slaveForm)) {
                    // 子表的標題
                    $slaveForm[$key]['title'] = json_decode($value['Options'], true);
                    $sumColumn = json_decode($value['SumColumn'], true);
                    // 子表的加總
                    foreach ($sumColumn as $keySumColumn => $valueSumColumn)
                        foreach ($items as $keyItems => $valueItems) {
                            if ($valueSumColumn === $keyItems) {
                                $sumColumn[$keySumColumn] = $valueItems['value'];
                            }
                        }
                    $slaveForm[$key]['data'][] = $sumColumn;
                }
            }
        }
        // dd($slaveForm);
        $binding = [
            'itecFormData' => $itecFormData,
            'itecFormDataLast' => $itecFormDataLast,
            'masterForm' => $masterForm,
            'slaveForm' => $slaveForm,
            'menu' => $this->menu,
            // 'items' => $items,
            // 'formTemplate' => $formTemplate,
            // 'formTableDynamicFields' => $formTableDynamicFields,
        ];
        // dd($binding);
        return view('pages.form_show', $binding);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $itecFormData = ItecFormData::findOrFail($id);
        $binding = [
            'itecFormData' => $itecFormData,
        ];
        return view('pages.form_edit', $binding);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'form_content' => function($attribute, $value, $fail) {
                libxml_use_internal_errors(true);
                $xml = simplexml_load_string($value);
                if (!$xml) {
                    $fail('The '.$attribute.' is invalid XML format.');
                }
            },
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $itecFormData = ItecFormData::findOrFail($id);
        $itecFormData->form_content = $request->form_content;
        $itecFormData->save();
        // dd($itecFormData);
        return redirect('pages/forms/' . $itecFormData->task_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ItecFormData  $itecFormData
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItecFormData $itecFormData)
    {
        //
    }

    /**
     * XML轉陣列
     * 
     * @param $xml
     * @return array
     */
    public function xmlToArray($xml)
    {
        return json_decode(json_encode(simplexml_load_string($xml)), true);
    }

    /**
     * 處理欄位型態轉換
     */
    public function field_process($value, $type)
    {
        switch ($type) {
            case 'upload':
                $value = explode(",", $value);
                break;
            case 'editor':
                $value = htmlspecialchars_decode($value);
                break;
            default:
                $value = $value;
                break;
        }
        return $value;
    }
}
