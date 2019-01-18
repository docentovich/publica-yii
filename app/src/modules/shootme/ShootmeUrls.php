<?php

namespace shootme;

use app\interfaces\ModuleUrls;
use shootme\models\ShootmePortfolio;

class ShootmeUrls implements ModuleUrls
{
    public static function frontUrls(): array
    {
        return [
            '' => 'project/front/index',
            '<page:\d+>' => 'project/front/index',
            'search' => 'project/front/search',
            '<action:\w+>/<id:\d+>' => 'project/front/<action>',
            '<action:[\w\-]+>' => 'project/front/<action>',
        ];
    }

    public static function backUrls(): array
    {
    }
}