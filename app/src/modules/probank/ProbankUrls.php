<?php

namespace app\modules\probank;

use app\interfaces\ModuleUrls;
use app\models\Portfolio;

class ProbankUrls implements ModuleUrls
{
    public static function frontUrls(): array
    {
        return [
            '' => 'project/front-specialists/index',
            'specialist/<id:\d+>' => 'project/front-specialists/specialist',
            '<type:(' . Portfolio::getSeparatedAllowedTypes() . ')>' => 'project/front-specialist/type'
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