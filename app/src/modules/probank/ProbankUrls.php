<?php

namespace app\modules\probank;

use app\interfaces\ModuleUrls;
use app\models\Portfolio;

class ProbankUrls implements ModuleUrls
{
    public static function urls()
    {
        return [
            '' => 'project/front-specialists/index',
            '<type:(' . Portfolio::getSeparatedAllowedTypes() . ')>' => 'project/front-specialist/type'
        ];
    }
}