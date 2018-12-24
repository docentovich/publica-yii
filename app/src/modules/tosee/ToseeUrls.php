<?php

namespace app\modules\tosee;


use app\interfaces\ModuleUrls;

class ToseeUrls implements ModuleUrls
{
    public static function urls()
    {
        return [
            // объявление правил здесь
            '' => 'project/front-post/index',
            'gen' => 'project/front-post/gen-pwd',
            '<page:\d+>' => 'project/front-post/index',
            '<date:[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])>' => 'project/front-post/date',
            '<date:[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])>/<page:\d+>' => 'project/front-post/date',
            'past' => 'project/front-post/past',
            'past/<page:\d+>' => 'project/front-post/index',
            'search' => 'project/front-post/search',
            '<action:[\w\-]+>/<id:\d+>' => 'project/front-post/<action>',
            '<action:[\w\-]+>' => 'project/front-post/<action>',
            '<action:[a-zA-Z\-\_]+>/<date:[\d\-]+>' => 'project/front-post/<action>',
        ];
    }
}