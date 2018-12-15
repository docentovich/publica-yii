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
                    '<controller:(author)>/<action:[a-zA-Z\-\_]+>/<id:\d+>' => '/tosee/<controller>/<action>',
                    '<controller:(author)>' => '/tosee/<controller>/index',
                    '<controller:(author)>/<action:[a-zA-Z\-\_]+>' => '/tosee/<controller>/<action>',
                ]
            );
        }
    }
}