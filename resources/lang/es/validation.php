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

    'accepted' => 'Esta opción :attribute debe ser aceptada.',
    'active_url' => 'La opción :attribute no es una URL válida.',
    'after' => 'La opción :attribute debe ser una fecha posterior a :date.',
    'after_or_equal' => 'La opción :attribute debe ser una fecha posterior o igual a :date.',
    'alpha' => 'La opción :attribute solo puede contener letras.',
    'alpha_dash' => 'La opción :attribute solo puede contener letras, números, y guiones.',
    'alpha_num' => 'La opción :attribute Solo puede contener letras y números.',
    'array' => 'La opción :attribute debe ser un array.',
    'before' => 'La opción :attribute debe ser una fecha antes de :date.',
    'before_or_equal' => 'La opción :attribute debe ser una fecha anterior o igual a :date.',
    'between' => [
        'numeric' => 'La opción :attribute debe estar entre :min y :max.',
        'file' => 'La opción :attribute debe estar entre :min y :max kilobytes.',
        'string' => 'La opción :attribute debe estar entre :min y :max caracteres.',
        'array' => 'La opción :attribute debe estar entre :min y :max Items.',
    ],
    'boolean' => 'La opción para el campo :attribute solo admite falso o verdadero.',
    'confirmed' => 'La confirmación de :attribute no coincide.',
    'date' => 'La opción :attribute no es una fecha válida.',
    'date_format' => 'La opción :attribute no está ceñida al formato :format.',
    'different' => 'La opción :attribute y :other deben ser diferentes.',
    'digits' => 'La opción :attribute debe tener :digits dígitos.',
    'digits_between' => 'La opción :attribute debe estar entre :min y :max dígitos.',
    'dimensions' => 'La opción :attribute tiene dimensiones de imagen inválidas.',
    'distinct' => 'El campo :attribute tiene un valor duplicado.',
    'email' => 'La opción :attribute debe ser una dirección válida de Email.',
    'exists' => 'La opción seleccionada :attribute es inválida.',
    'file' => 'La opción :attribute debe ser un archivo.',
    'filled' => 'El campo :attribute debe tener un valor.',
    'image' => 'La opción :attribute debe ser una imagen.',
    'in' => 'La opción :attribute seleccionada es inválida.',
    'in_array' => 'El campo :attribute no existe en :other.',
    'integer' => 'La opción :attribute debe ser un entero.',
    'ip' => 'la opción :attribute debe ser una dirección IP válida.',
    'json' => 'La opción :attribute debe ser un string JSON válido.',
    'max' => [
        'numeric' => 'La opción :attribute no puede ser mayor de :max.',
        'file' => 'La opción :attribute no puede ser mayor de :max kilobytes.',
        'string' => 'La opción :attribute no puede tener más de :max caracteres.',
        'array' => 'La opción :attribute no puede contener más de :max Items.',
    ],
    'mimes' => 'La opción :attribute debe ser un archivo de tipo: :values.',
    'mimetypes' => 'La opción :attribute debe ser un archivo de tipo: :values.',
    'min' => [
        'numeric' => 'La opción :attribute debe ser al menos de :min.',
        'file' => 'La opción :attribute debe tener por lo menor :min kilobytes.',
        'string' => 'La opción :attribute debe tener al menos :min caracteres.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'La opción :attribute seleccionada es inválida.',
    'numeric' => 'La opción :attribute debe ser un número.',
    'present' => 'El campo :attribute debe estar presente.',
    'regex' => 'El formato para :attribute es inválido.',
    'required' => 'El campo :attribute es requerido.',
    'required_if' => 'El campo :attribute es requerido cuando :other es :value.',
    'required_unless' => 'El campo :attribute es requerido a menos que :other esté en :values.',
    'required_with' => 'El campo :attribute es requerido cuando está presente :values.',
    'required_with_all' => 'El campo :attribute es requerido cuando está presente :values.',
    'required_without' => 'El campo :attribute es requerido cuando :values no está presente.',
    'required_without_all' => 'El campo :attribute es requerido cuando ninguno de estos valores :values estén persentes.',
    'same' => 'La opción :attribute y la opción :other deben coincidir.',
    'size' => [
        'numeric' => 'La opción :attribute debe ser :size.',
        'file' => 'La opción :attribute debe tener :size kilobytes.',
        'string' => 'La opción :attribute debe tener :size caracteres.',
        'array' => 'La opción :attribute debe contener :size Items.',
    ],
    'string' => 'La opción  :attribute debe ser un string.',
    'timezone' => 'La opción :attribute debe tener una zona válida.',
    'unique' => 'La opción :attribute ya se encuentra en uso.',
    'uploaded' => 'La opción :attribute no se pudo cargar al servidor.',
    'url' => 'El formato para :attribute es inválido.',
    'the_business_name_is_required' => 'El nombre de negocio es requerido',
    'this_field_may_not_contain_more_than_100_characters' => 'Este campo no puede contener más de 100 caracteres',
    'an_email_address_is_required' => 'Una dirección de Email es requerida',
    'enter_a_valid_business_phone_number_in_an_international_e164_format_without_starting_with_the_sign' => 'Ingrese un número válido para teléfono de negocio, en formato internacional e164 sin incluir el signo + al comienzo',
    'enter_a_business_web_address_here_starting_with_http_or_https' => 'Ingrese una dirección web de negocio aquí, iniciando con http:// o https://',
    'a_default_international_dialing_country_code_is_required' => 'Un código telefónico internacional por defecto es requerido',
    'an_actual_business_address_is_required' => 'Una dirección de negocios vigente es requerida',
    'an_address_city_is_required' => 'Una ciudad de residencia es requerida',
    'a_address_country_is_required' => 'Un país de residencia es requerido',
    'this_is_a_required_field' => 'Es es un campo requerido',
    'this_field_is_required_and_may_contain_integer_numbers_only' => 'Este campo es requerido y solo debe contener números enteros',

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
