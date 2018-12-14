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
        if ($app->id === "app-backend") {
            $app->getUrlManager()->addRules(
                [
                    'search' => '/tosee/post/search',
                    '<_c:(author|moderator|director)>/<_a:[a-zA-Z\-\_]+>/<id:\d+>' => '/tosee/<_c>/<_a>',
                    '<_c:(author|moderator|director)>' => '/tosee/<_c>/index',
                    '<_c:(author|moderator|director)>/<_a:[a-zA-Z\-\_]+>' => '/tosee/<_c>/<_a>',
                ]
            );
        }
    }
}