<?php

return [
    'navigation_label' => 'Pacientes',

    'label' => 'Paciente',

    'plural_label' => 'Pacientes',

    'labels' => [
        'id' => 'ID',
        'professional' => 'Profesional',
        'name' => 'Nombre',
        'lastname' => 'Apellido',
        'rut' => 'RUT',
        'birthday' => 'Fecha de Nacimiento',
        'email' => 'Correo Electrónico',
        'phone' => 'Teléfono',
        'created_at' => 'Fecha de Creación',
    ],

    'messages' => [
        'required' => 'El campo :attribute es obligatorio.',
        'unique' => 'El campo :attribute ya está en uso.',
        'max' => 'El campo :attribute no puede tener más de :max caracteres.',
        'email' => 'El campo :attribute debe ser una dirección de correo válida.',
    ],

    'attributes' => [
        'id' => 'ID',
        'name' => 'nombre',
        'lastname' => 'apellido',
        'rut' => 'RUT',
        'birthday' => 'fecha de nacimiento',
        'email' => 'correo electrónico',
        'phone' => 'teléfono',
    ],
];