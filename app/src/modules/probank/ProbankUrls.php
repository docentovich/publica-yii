<?php

namespace probank;

use app\interfaces\ModuleUrls;
use probank\models\ProbankPortfolio;

class ProbankUrls implements ModuleUrls
{
    public static function frontUrls(): array
    {
        return [
            '' => 'project/front-specialists/index',
            'specialist/<id:\d+>' => 'project/front-specialists/specialist',
            'search' => 'project/front-specialists/search',
            '<type:(' . strtolower(ProbankPortfolio::getSeparatedAllowedTypes('|') ) . ')>' => 'project/front-specialists/type',
            'specialist/<sellers_id:\d+>/order/<action:[\w\-]+>' => 'project/orders/<action>',

        ];
    }

    public static function backUrls(): array
    {
        return [
            'search' => '/probank/specialist/search',
            '<controller:(model|photographer)>/<action:[a-zA-Z\-\_]+>/<id:\d+>' => '/probank/<controller>/<action>',
            '<controller:(model|photographer)>/<action:[a-zA-Z\-\_]+>' => '/probank/<controller>/<action>',
            '<controller:(model|photographer)>' => '/probank/<controller>/index',
        ];
    }
}