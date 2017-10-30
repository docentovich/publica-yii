<?php
return [
    'defaultRoute' => 'probank/site/index',
    'bootstrap'    => [
        'modules\probank\Bootstrap',
    ],
    'components'   => [
        'errorHandler' => [
            'errorAction' => 'probank/site/error',
        ],
    ],
];