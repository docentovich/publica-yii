<?php

namespace shootme;

use yii\base\BootstrapInterface;

class FrontendBootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        $app->getUrlManager()->addRules(
            [
                // объявление правил здесь
                '' => 'project/front/index',
                '<page:\d+>' => 'project/front/index',
                'search' => 'project/front/search',
                '<action:\w+>/<id:\d+>' => 'project/site/<action>',
                '<action:[\w\-]+>' => 'project/site/<action>',
            ]
        );
    }
}