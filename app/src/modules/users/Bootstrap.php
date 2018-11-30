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
                    '/' => '/user/settings/profile',
                    'choose-role' => '/user/registration/choose-role',
                    'save-user' => '/user/settings/save-user-form',
                    'save-profile' => '/user/settings/save-profile-form',
                    'profile/upload-avatar'    => '/user/settings/upload-avatar',
                    'avatar-upload'    => '/user/settings/upload-avatar',
                    '<action:[\w\-]+>' => '/user/settings/<action>',
                ]
            );
        }
    }
}