<?php

namespace users;

use users\controllers\RegistrationController;
use users\services\UserService;
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
                    'my/<controller:[\w\-]+>/<action:[\w\-]+>'    => '/user/<controller>/<action>',
                    'my/<controller:[\w\-]+>'    => '/user/<controller>/index',
                    '<action:(account|networks|disconnect|delete|set-city)>' => '/user/settings/<action>',
                ]
            );
        }

        \Yii::$container->setSingleton('UserService', ["class" => UserService::class]);
        \Yii::$container->set(RegistrationController::class, [
            'userService' =>  \Yii::$container->get('UserService')
        ]);
    }
}