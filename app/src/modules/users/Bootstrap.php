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
        $app->getUrlManager()->addRules(
            [
                '<controller:(city)>/<action:[\w\-]+>/<id:\d+>'    => '/user/<controller>/<action>',
                '<controller:(city)>/<action:[\w\-]+>'    => '/user/<controller>/<action>',
            ]
        );
        if( $app->id === "app-backend"){
            $app->getUrlManager()->addRules(
                [
                    '/' => '/user/settings/profile',
                    'choose-role' => '/user/registration/choose-role',
                    'save-user' => '/user/settings/save-user-form',
                    'save-profile' => '/user/settings/save-profile-form',
                    'profile/upload-avatar'    => '/user/settings/upload-avatar',
                    'avatar-upload'    => '/user/settings/upload-avatar',
                    'my/<controller:[\w\-]+>/<action:[\w\-]+>'    => '/user/<controller>/<action>',
                    'my/<controller:[\w\-]+>'    => '/user/<controller>/index',
                    '<action:[\w\-]+>' => '/user/settings/<action>',
                ]
            );
        }
    }
}