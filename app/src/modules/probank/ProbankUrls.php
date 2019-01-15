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
            'specialist/<portfolio_id:\d+>' => 'project/front-specialists/specialist',
            'search' => 'project/front-specialists/search',
            '<type:(' . strtolower(ProbankPortfolio::getSeparatedAllowedTypes('|') ) . ')>' => 'project/front-specialists/type',
            'specialist/<portfolio_id:\d+>/order/<action:[\w\-]+>' => 'project/orders/<action>',
            '<action:[\w\-]+>/<id:\d+>' => 'project/front-specialists/<action>',
            '<action:[\w\-]+>' => 'project/front-specialists/<action>',
            '<action:[a-zA-Z\-\_]+>/<date:[\d\-]+>' => 'project/front-specialists/<action>',
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