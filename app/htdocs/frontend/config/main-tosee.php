<?php
return [
    'defaultRoute' => 'tosee/site/index',
    'bootstrap'    => [
        'modules\tosee\Bootstrap',
    ],
    'components'   => [
        'errorHandler' => [
            'errorAction' => 'probank/site/error',
        ],
    ],
];