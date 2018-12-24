<?php

namespace app\modules\probank;

use app\modules\tosee\services\ProbankImagesService;
use app\services\BaseImagesService;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap ( $app )
    {
        \Yii::$container->set(BaseImagesService::class, ProbankImagesService::class);
    }
}