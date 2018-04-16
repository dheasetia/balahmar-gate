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

    'accepted'             => 'The :attribute must be accepted.',
    'active_url'           => 'The :attribute is not a valid URL.',
    'after'                => 'The :attribute must be a date after :date.',
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => 'The :attribute may only contain letters.',
    'alpha_dash'           => 'The :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
    'array'                => 'The :attribute must be an array.',
    'before'               => 'The :attribute must be a date before :date.',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file'    => 'The :attribute must be between :min and :max kilobytes.',
        'string'  => 'The :attribute must be between :min and :max characters.',
        'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => 'The :attribute must be a valid email address.',
    'exists'               => 'The selected :attribute is invalid.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'The :attribute field is required.',
    'image'                => 'The :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file'    => 'The :attribute may not be greater than :max kilobytes.',
        'string'  => 'The :attribute may not be greater than :max characters.',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'mimetypes'            => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'The :attribute must be at least :min.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => 'The :attribute must be at least :min characters.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => 'The :attribute field is required.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => 'The :attribute has already been taken.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'The :attribute format is invalid.',

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
        'name' => [
            'required' => 'الاسم مطلوب.',
            'min'   => 'الاسم أقل من ٦ أحرف.'
        ],
        'email' => [
            'required'  => 'الأيميل مطلوب.',
            'email' => 'الإيميل غير صحيح.',
            'unique'    => 'الأيميل مسجل مسبقا.'
        ],
        'mobile'    => [
            'required'  => 'رقم الجوال مطلوب.',
            'digits'    => 'رقم الجوال غير صحيح.',
            'unique'    => 'رقم الجوال مسجل مسبقا.'
        ],
        'national_id'   => [
            'required'  => 'رقم الهوية الوطنية مطلوب.',
            'numeric'   => 'رقم الهوية الوطنية غير صحيح.',
            'unique'    => 'رقم الهوية الوطنية مسجل مسبقا.'
        ],
        'password'  => [
            'required'  => 'كلمة المرور مطلوب.',
            'min'   => 'كلمة المرور قصيرة.',
            'confirmed' => 'تأكيد كلمة المرور غير مطابق.'
        ],
        'advisor_id'    => [
            'required'  => 'الجهة المشرفة مطلوبة.',
            'numeric'   => 'الجهة المشرفة غير صحيح.'
        ],
        'manager_name'  => [
            'required'  => 'اسم المدير مطلوب.',
            'min'       => 'الاسم أقل من ٦ أحرف.'
        ],
        'license_no'    => [
            'required'  => 'رقم التصريح مطلوب.',
            'numeric'   => 'رقم التصريح غير صحيح.'
        ],
        'license_date'  => [
            'required'  => 'تاريخ الترخيص مطلوب.'
        ],
        'license_file'  => [
            'required'  => 'صورة الترخيص مطلوب.',
            'mimes'      => 'صيغة الملف غير صحيح.',
            'max'       => 'حجم الملف أكبر من ٢ ميغا'
        ],
        'bank_file'  => [
            'required'  => 'صورة الترخيص مطلوب.',
            'mime'      => 'صيغة الملف غير صحيح.',
            'max'       => 'حجم الملف أكبر من ٢ ميغا'
        ],

        'bank_id'   => [
            'required'  => 'اسم البنك مطلوب.',
            'numeric'   => 'اسم البنك غير صحيح.'
        ],
        'iban'      => [
            'required'  => 'رقم الآيبان مطلوب.',
            'iban'      => 'تم تسجيل الآيبان مسبقا.',
            'unique'    => 'رقم الآيبان مسجل مسبقا.'
        ],
        'representative'    => [
            'required'  => 'اسم ممثل الجهة مطلوب.',
            'min'       => 'اسم ممثل الجهة أقل من ٦ أحرف.'
        ],
        'role'          => [
            'required'  => 'صفة ممثل الجهة مطلوب'
        ],
        'phone'     => [
            'required'  => 'رقم الهاتف مطلوب.',
            'numeric'   => 'رقم الهاتف غير صحيح٫.'
        ],
        'second_phone'  => [
            'numeric'   => 'رقم الهاتف الثاني غير صحيح.'
        ],
        'fax'           => [
            'numeric'   => 'رقم الفاكس غير صحيح.'
        ],
        'area_id'       => [
            'required'  => 'المطقة مطلوبة.',
            'numeric'   => 'اسم المطقة غير صحيح.'
        ],
        'city_id'       => [
            'required'  => 'المدينة مطلوبة.',
            'numeric'   => 'المدينة غير صحيح.'
        ],
        'building_no'   => [
            'numeric'   => 'رقم المبنى غير صحيح.'
        ],
        'additional_no' => [
            'numeric'   => 'الرقم الإضافي غير صحيح.'
        ],
        'zip_code'      => [
            'numeric'   => 'الرمز البريدي غير صحيح.'
        ],
        'coordinate'    => [
            'alpha_num' => 'رقم الإحداثيات غير صحيح.'
        ],
        'logo'          => [
            'max'       => 'حجم الملف أكبر من ٢ ميغا.',
            'image'     => 'صيغة الملف غير صحيح.'
        ],
        'project_name'  => [
            'required'  => 'السم المشروع مطلوب.'
        ],
        'description'   => [
            'required'  => 'التعريف مطلوب.'
        ],
        'responsible_person' => [
            'required'  => 'الشخص الممثل مطلوب.'
        ],
        'kind_id'   => [
            'required'  => 'النوع مطلوب.'
        ],
        'execution_date'    => [
            'required'  => 'تاريخ التنفيذ مطلوب.'
        ],
        'document_path' => [
            'required' => 'الملف مطلوب.',
            'mimes' => 'صيغة الملف غير صحيح.'
        ],
        'path' => [
            'required' => 'ملف الصورة فارغ.',
            'mimes' => 'صيغة الملف غير صحيح.',
            'image' => 'الملف غير صحيح (يلزم أن يكون صرورة).'
        ],
        'subject'   => [
            'required'  => 'موضوع العنوان مطلوب.'
        ],
        'body'  => [
            'required'  => 'نص الإشعار مطلوب.'
        ],
        'recipients'    => [
            'required'  => 'يجب أن تختار واحدا على الأقل من المرسل إليهم'
        ],
        'forgotten_email'   => [
            'required'  => 'عنوان البريد اإلكتروني إلزامي.',
            'email'     => 'عنوان البريد الإلكتروني غير صحيح.'
        ],
        'donation_requested'    => [
            'required'  => 'تكلفة المشروع إلزامي',
            'numeric'   => 'المطلوب الأرقام بالإنجليزية'
        ],
        'hijri_received'    => [
            'required'  =>  'تاريخ الاستلام بالهجري مطلوب.'
        ],
        'date_received'    => [
            'required'  =>  'تاريخ الاستلام بالميلادي مطلوب.'
        ],
        'receiver_name' => [
            'required'  => 'اسم المستلم مطلوب.',
        ],
        'amount'    => [
            'required'  => 'المبلغ مطلوب.',
            'numeric'   => 'المبلغ يلزم أن يكون بالأرقام الإنجليزية.'
        ]
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
