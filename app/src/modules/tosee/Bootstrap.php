<?php

namespace app\modules\tosee;

use app\modules\tosee\services\ToseeImagesService;
use app\modules\tosee\services\ToseePostService;
use app\services\BaseImagesService;
use app\services\BasePostService;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap ( $app )
    {
        $app->urlManagerFrontEnd->addRules(ToseeUrls::frontUrls());
        \Yii::$container->set(BasePostService::class, ToseePostService::class);
        \Yii::$container->set(BaseImagesService::class, ToseeImagesService::class);
    }
}