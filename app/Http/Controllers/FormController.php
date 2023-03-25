<?php

namespace App\Http\Controllers;

use App\ItecFormData;
use Illuminate\Http\Request;

class FormController extends Controller
{

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
     * @param  \App\ItecFormData  $itecFormData
     * @return \Illuminate\Http\Response
     */
    public function show(ItecFormData $itecFormData, $a_template_view = [], $a_data_view = [], $a_table_view = [])
    {
        $a_form_xml = $this->xmlToArray($itecFormData->form_info->form_xml);
        $a_form_content = $this->xmlToArray($itecFormData->form_content);

        $o_table_view = collect($a_form_xml['FormStructure']['item'])->keyBy('ID');
        // dd($a_form_xml);
        // dd($a_form_content);
        // dd($o_table_view);

        foreach($a_form_content['FormTemplate'] as $key => $value) {
            $new_key = str_replace($itecFormData->form_info->simple_code . '_', '', $key);
            $a_template_view[$new_key] = [
                'field_id' => $key,
                'value' => $value,
            ];
            
            // 比對template與items的key值, 符合的合併在一起
            if (array_key_exists($new_key, $o_table_view->all())) {
                foreach ($o_table_view[$new_key] as $key => $value) {
                    $a_template_view[$new_key][$key] = $value;
                }
            }
        }
        // exit;
        // 主表內容
        foreach ($a_template_view as $key => $value) {
            // 檢查 key 是否 Field 開頭 , 檢查是否有 Label 及 Value
            if ((str_contains($key, 'DynamicFields_Field') === false) and (str_contains($key, 'grid') === false) and (str_contains($key, 'DynamicFields') === false)) {
                // exit;
                if (isset($value['Label']) && isset($value['value'])) {
                    // exit;
                    $value['value'] = empty($value['value']) ? '' : (string) $value['value'];
                    if (in_array($value['Type'], $this->field_type)) {
                        
                        $value['value'] = $this->field_process($value);
                    }
                    $a_data_view[$key] = $value;
                    
                }
            }
        }
        // exit;
        // 子表內容
        if (isset($a_template_view['DynamicFields'])) {
            $form_talbe = json_decode($a_template_view['DynamicFields']['value'], true);
            foreach ($form_talbe as $key => $value) {
                foreach ($value['Data'] as $data_key => $data_value) {
                    $a_form_table[$key][$data_key] = $o_table_view[$data_key];
                    $a_form_table[$key][$data_key]['value'] = $data_value;
                }
                // 儲存子表格欄位的數值
                $a_table_view[$value['Code']]['data'][] = $a_form_table[$key];
                // 儲存子表格欄位的標題
                if (!isset($a_table_view[$value['Code']]['title'])) {
                    foreach ($a_table_view[$value['Code']]['data'] as $k => $v) {
                        foreach ($v as $val) {
                            $a_table_view[$value['Code']]['title'][] =  $val['Label'];
                        }
                    }
                }
            }
        }

        $binding = [
            'itecFormData' => $itecFormData,
            // 'itecFormInfo' => $itecFormData->form_info,
            'a_form_data' => $a_data_view,
            'a_form_table' => $a_table_view,
        ];
        // dd($binding);
        return view('pages.form_show', $binding);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItecFormData  $itecFormData
     * @return \Illuminate\Http\Response
     */
    public function edit(ItecFormData $itecFormData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItecFormData  $itecFormData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItecFormData $itecFormData)
    {
        //
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
    public function field_process($value)
    {
        switch ($value['Type']) {
            case 'upload':
                $value['value'] = explode(",", $value['value']);
                break;
            case 'editor':
                $value['value'] = htmlspecialchars_decode($value['value']);
                break;
        }
        return $value['value'];
    }
}