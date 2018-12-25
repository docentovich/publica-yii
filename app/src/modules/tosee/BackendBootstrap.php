<?php

namespace app\modules\tosee;

use yii\base\BootstrapInterface;

class BackendBootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        $app->getUrlManager()->addRules(ToseeUrls::backUrls());
    }
}