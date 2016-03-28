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

    'accepted'             => 'ال :attribute يجب ان تكون مقبولة',
    'active_url'           => 'ال :attribute ليس عنوان صالح',
    'after'                => 'ال :attribute يجب ان يكون تاريخ بعد :date',
    'alpha'                => 'ال :attribute يجب ان تحتوي علي احرف فقط',
    'alpha_dash'           => 'ال :attribute يجب ان تحتوي علي أحرف وأرقام وعلامات',
    'alpha_num'            => 'ال :attribute يجب ان تحتوي علي أحرف وأرقام',
    'array'                => 'ال :attribute يجب ان تكون مجموعة.',
    'before'               => 'ال :attribute يجب ان يكون تارخ بعد :date',
    'between'              => [
        'numeric' => 'ال :attribute يجب ان يكون ما بين :min  وبين  :max',
        'file'    => 'ال :attribute يجب ان يكون ما بين :min  وبين  :max kilobytes',
        'string'  => 'ال :attribute يجب ان يكون ما بين  :min  وبين  :max  حرف',
        'array'   => 'ال :attribute يجب ان يكون ما بين  :min  وبين  :max  عنصر',
    ],
    'boolean'              => 'ال :attribute يجب ان يكون صحيح أو خاطئ',
    'confirmed'            => 'ال :attribute غير متطابقة',
    'date'                 => 'ال :attribute ليس تاريخ صحيح',
    'date_format'          => 'ال :attribute لا يتطابق مع :format',
    'different'            => 'ال :attribute وال :other  يجب ان تكون مختلفة',
    'digits'               => 'ال :attribute يجب ان يكون :digite أرقام',
    'digits_between'       => 'ال :attribute يجب ان يكون ما بين  :min  وبين  :max  رقم',
    'email'                => 'يجب ادخال :attribute بشكل صحيح',
    'filled'               => ' :attribute يجب الا يكون فارغ',
    'exists'               => 'الاختيار :attribute سمة غير صالحة',
    'image'                => 'ال :attribute يجب ان يكون صورة',
    'in'                   => 'الاختيار :attribute غير صالح',
    'integer'              => 'ال :attribute يجب ان يكون رقما صحيحا',
    'ip'                   => 'ال :attributes يجب أن يكون عنوان IP صالح',
    'max'                  => [
        'numeric' => 'ال :attribute قد لا يكون أكبر من :max',
        'file'    => 'ال :attribute قد لا يكون أكبر من :max  كيلو بايت',
        'string'  => 'ال :attribute قد لا يكون أكبر من :max  حرف ',
        'array'   => 'ال :attribute قد لا يكون أكبر من :max  عنصر ',
    ],
    //'mimes'                => 'The :attribute must be a file of type: :values.',
    'mimes'                => 'ال :attribute يجب ان يكون ملف من نوع: :values',
    'min'                  => [
        'numeric' => ' :attribute يجب ان يكون علي الأقل :min',
        'file'    => ' :attribute يجب ان يكون علي الاقل :min  كيلو بايت',
        'string'  => ' :attribute يجب ان تكون علي الاقل :min  أحرف ',
        'array'   => 'ال :attribute يجب ان تكون علي الاقل :min  عناصر ',
    ],
    'not_in'               => 'الإختيار :attribute غير صالح',
    'numeric'              => 'ال :attribute يجب ان يكون رقم',
    'regex'                => 'ال :attribute تنسيق غير صالح',
    'required'             => '  :attribute مطلوب',
    //'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_if'          => 'ال :attribute  مطلوب عندما :other يكون  :value',
    'required_with'        => 'ال :attribute مطلوب عندما تكون  :values  موجودة',
    'required_with_all'    => 'ال :attribute مطلوب عندما تكون  :values  موجودة',
    'required_without'     => 'ال :attribute مطلوب عندما تكون  :values  غير موجودة',
    'required_without_all' => 'The :attribute field is required when none of :values are present',
    'same'                 => 'ال :attribute و  :other  يجب ان تكون متطابقة',
    'size'                 => [
        'numeric' => 'ال :attribute يجب ان تكون :size',
        'file'    => 'ال :attribute يجب ان تكون  :size  كيلوبايت',
        'string'  => 'ال :attribute يجب ان تكون  :size  أحرف',
        'array'   => 'ال :attribute يجب ان تحتوي علي :size  عناصر',
    ],
    'string'               => 'ال :attribute يجب ان تكون حروف فقط',
    'timezone'             => 'ال :attribute يجب ان تكون منطقة صالحة',
    'unique'               => ':attribute موجود مسبقا',
    'url'                  => 'ال :attribute سمة غير صالحة',

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
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
