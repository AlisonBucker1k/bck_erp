<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | El following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'El :attribute debe ser aceptado.',
    'active_url'           => 'El :attribute no es una URL valida.',
    'after'                => 'El :attribute debe ser una fecha posterior a :date.',
    'after_or_equal'       => 'El :attribute debe ser una fecha posterior o igual a :date.',
    'alpha'                => 'El :attribute solo debe contener letras.',
    'alpha_dash'           => 'El :attribute solo debe contener letras, numeros, y guiones.',
    'alpha_num'            => 'El :attribute solo debe contener letras y numeros.',
    'array'                => 'El :attribute debe ser un array.',
    'before'               => 'El :attribute debe ser una fecha anterior a :date.',
    'before_or_equal'      => 'El :attribute debe ser una fecha anterior o igual a :date.',
    'between'              => [
        'numeric' => 'El :attribute debe ser entre :min y :max.',
        'file'    => 'El :attribute debe ser entre :min y :max kilobytes.',
        'string'  => 'El :attribute debe ser entre :min y :max caracteres.',
        'array'   => 'El :attribute debe tener entre :min y :max items.',
    ],
    'boolean'              => 'El :attribute debe ser verdadero o falso.',
    'confirmed'            => 'El :attribute de confirmacion no es igual.',
    'date'                 => 'El :attribute no es una fecha valida.',
    'date_format'          => 'El :attribute no tiene el formato: :format.',
    'different'            => 'El :attribute y :other deben ser diferentes.',
    'digits'               => 'El :attribute debe ser :digits digitos.',
    'digits_between'       => 'El :attribute debe tener entre :min y :max digitos.',
    'dimensions'           => 'El :attribute tiene las dimensiones de imagen incorrectas.',
    'distinct'             => 'El :attribute tiene un campo con valor duplicado.',
    'email'                => 'El :attribute debe ser un direccion de E-Mail valida.',
    'exists'               => 'El :attribute seleccionado es invalido.',
    'file'                 => 'El :attribute debe ser un archivo.',
    'filled'               => 'El :attribute debe tener un valor.',
    'image'                => 'El :attribute debe ser ana imagen.',
    'in'                   => 'El :attribute seleccionado es invalido.',
    'in_array'             => 'El :attribute no existe en :other.',
    'integer'              => 'El :attribute debe ser una integral.',
    'ip'                   => 'El :attribute debe ser una direccion IP valida.',
    'ipv4'                 => 'El :attribute debe ser una direccion IPv4 valida.',
    'ipv6'                 => 'El :attribute debe ser una direccion IPv6 valida.',
    'json'                 => 'El :attribute debe ser un JSON valido.',
    'max'                  => [
        'numeric' => 'El :attribute no debe ser mas grande que :max.',
        'file'    => 'El :attribute no debe ser mas grande que :max kilobytes.',
        'string'  => 'El :attribute no debe ser mas grande que :max caracteres.',
        'array'   => 'El :attribute no debe tener mas que :max items.',
    ],
    'mimes'                => 'El :attribute debe ser un archivo de tipo: :values.',
    'mimetypes'            => 'El :attribute debe ser un archivo de tipo: :values.',
    'min'                  => [
        'numeric' => 'El :attribute debe tener al menos :min.',
        'file'    => 'El :attribute debe tener al menos :min kilobytes.',
        'string'  => 'El :attribute debe tener al menos :min caracteres.',
        'array'   => 'El :attribute debe tener al menos :min items.',
    ],
    'not_in'               => 'El :attribute seleccionado es invalido.',
    'numeric'              => 'El :attribute debe ser un numero.',
    'present'              => 'El :attribute debe ser presente.',
    'regex'                => 'El formato de :attribute es invalido.',
    'required'             => 'El :attribute (campo) es requerido.',
    'required_if'          => 'El :attribute (campo) es requerido cuando :other es :value.',
    'required_unless'      => 'El :attribute (campo) es requerido a menos que :other es in :values.',
    'required_with'        => 'El :attribute (campo) es requerido cuando :values es present.',
    'required_with_all'    => 'El :attribute (campo) es requerido cuando :values es present.',
    'required_without'     => 'El :attribute (campo) es requerido cuando :values es not present.',
    'required_without_all' => 'El :attribute (campo) es requerido cuando none of :values are present.',
    'same'                 => 'El :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'El :attribute debe ser :size.',
        'file'    => 'El :attribute debe ser :size kilobytes.',
        'string'  => 'El :attribute debe ser :size caracteres.',
        'array'   => 'El :attribute debe contener :size items.',
    ],
    'string'               => 'El :attribute debe ser un string.',
    'timezone'             => 'El :attribute debe ser una zona valida.',
    'unique'               => 'El :attribute ya fue tomado.',
    'uploaded'             => 'El :attribute fallo al cargar.',
    'url'                  => 'El :attribute (formato) es invalido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify un specific custom language line for un given attribute rule.
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
    | El following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages un little cleaner.
    |
    */

    'attributes' => [],

];
