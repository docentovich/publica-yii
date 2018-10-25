<?php

namespace app\modules\users;

use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap ( $app )
    {
        if( $app->id === "app-backend"){
            $app->getUrlManager()->addRules(
                [
                    'GET /' => '/user/settings/profile',
                    'POST /' => '/user/settings/post-user-form',
                    'avatar-upload'    => '/user/settings/upload-avatar',
                    '<action:[\w\-]+>' => '/user/settings/<action>',
                ]
            );
        }
    }
}