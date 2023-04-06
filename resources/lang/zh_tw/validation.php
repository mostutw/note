<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => '必須接受 :attribute',
    'active_url'           => ':attribute 必須是可使用的URL地址',
    'after'                => ':attribute 必須是在 :date 之後的日期',
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => ':attribute 只能包含英文字母',
    'alpha_dash'           => ':attribute 只能包含英文字母，數字和-',
    'alpha_num'            => ':attribute 只能包含英文字母和數字',
    'array'                => ':attribute 必須是陣列',
    'before'               => ':attribute 必須是在 :date. 之前的日期',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => ':attribute 必須介於 :min 至 :max 之間',
        'file'    => ':attribute 大小必須介於 :min kb 至 :max kb 之間',
        'string'  => ':attribute 長度必須介於 :min 至 :max 之間',
        'array'   => ':attribute 包含的長度必須介於 :min 至 :max 個之間',
    ],
    'boolean'              => ':attribute 必須是 true 或 false',
    'confirmed'            => ':attribute 必須一致',
    'date'                 => ':attribute 不是有效的日期',
    'date_equals'          => 'The :attribute must be a date equal to :date.',
    'date_format'          => ':attribute 必須符合格式 :format',
    'different'            => ':attribute 與 :other 必須不同',
    'digits'               => ':attribute 必須是 :digits 位數',
    'digits_between'       => ':attribute 的位數必須介於 :min 與 :max 之間',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => ':attribute 已存在',
    'email'                => ':attribute 必須是有效的電子郵件位址',
    'ends_with'            => 'The :attribute must end with one of the following: :values',
    'exists'               => ':attribute 須存在',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => ':attribute 為必填',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => ':attribute 不能大於 :max',
        'file'    => ':attribute 的大小不能超過 :max kb',
        'string'  => ':attribute 不能超過 :max 個字元',
        'array'   => ':attribute 不能包含超過 :max 個',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => ':attribute 必須是 :size',
        'file'    => ':attribute 必須是 :size kb',
        'string'  => ':attribute 必須有 :size 個字元',
        'array'   => ':attribute 必須包含 :size 個',
    ],
    'starts_with'          => 'The :attribute must start with one of the following: :values',
    'string'               => ':attribute 必須是字串',
    'timezone'             => ':attribute 必須是有效的時區',
    'unique'               => ':attribute 已存在',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => ':attribute 必須是有效的url',
    'uuid'                 => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
