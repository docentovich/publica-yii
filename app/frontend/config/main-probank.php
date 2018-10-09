<?php

define( "PROJECT", PROBANK );

return [
    'bootstrap' => [
        'modules\probank\Bootstrap',
        'modules\users\Bootstrap',
    ],
    'modules'   => [
        'project' => [
            'class' => 'modules\probank\Module',
        ],

    ],
];