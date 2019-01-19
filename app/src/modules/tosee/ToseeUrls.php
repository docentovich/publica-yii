<?php

namespace tosee;


use app\interfaces\ModuleUrls;

class ToseeUrls implements ModuleUrls
{
    public static function frontUrls(): array
    {
        return [
            '' => 'project/front-post/index',
            'check-email' => 'project/front-post/check-email',
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

    public static function backUrls(): array
    {
        return [
            'search' => '/tosee/post/search',
            '<controller:(author)>/<action:[a-zA-Z\-\_]+>/<id:\d+>' => '/tosee/<controller>/<action>',
            '<controller:(author)>' => '/tosee/<controller>/index',
            '<controller:(author)>/<action:[a-zA-Z\-\_]+>' => '/tosee/<controller>/<action>',
        ];
    }
}