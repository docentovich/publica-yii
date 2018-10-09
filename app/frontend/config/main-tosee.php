<?php

define( "PROJECT", TOSEE );

return [
    'bootstrap' => [
        'modules\tosee\Bootstrap',
        'modules\users\Bootstrap',
    ],
    'modules'   => [
        'project'   => [
            'class' => 'modules\tosee\Module',
        ],
    ],
];