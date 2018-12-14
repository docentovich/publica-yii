<?php

namespace app\modules\tosee;


class Urls
{
    public static $frontUrls = [
        // объявление правил здесь
        ''                                       => 'project/post/index',
        'gen'                                    => 'project/post/gen-pwd',
        '<page:\d+>'                             => 'project/post/index',
        '<date:[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])>'            => 'project/post/date',
        '<date:[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])>/<page:\d+>' => 'project/post/date',
        'past'                                   => 'project/post/past',
        'past/<page:\d+>'                        => 'project/post/index',
        'search'                                 => 'project/post/search',
        '<action:[\w\-]+>/<id:\d+>'              => 'project/post/<action>',
        '<action:[\w\-]+>'                       => 'project/post/<action>',
        '<action:[a-zA-Z\-\_]+>/<date:[\d\-]+>'  => 'project/post/<action>',
    ];
}