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

        if( $app->id === "app-backend"){
            $app->getUrlManager()->addRules(
                [
                    '<_c:(photographer|model)>'                    => '/probank/<_c>/index',
                    '<_c:(photographer|model)>/<_a:[a-zA-Z\-\_]+>' => '/probank/<_c>/<_a>',
                ]
            );
        }
    }
}