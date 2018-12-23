<?php
namespace app\modules\probank;

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
                    'search' => '/probank/specialist/search',
                    '<controller:(model|photographer)>/<action:[a-zA-Z\-\_]+>/<id:\d+>' => '/probank/<controller>/<action>',
                    '<controller:(model|photographer)>/<action:[a-zA-Z\-\_]+>' => '/probank/<controller>/<action>',
                    '<controller:(model|photographer)>' => '/probank/<controller>/index',
                ]
            );
        }
    }
}