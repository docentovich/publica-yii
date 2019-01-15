<?php

namespace publica;

use yii\base\BootstrapInterface;

class FrontendBootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        $app->getUrlManager()->addRules([
            '' => 'project/front/index',
        ]);
    }
}