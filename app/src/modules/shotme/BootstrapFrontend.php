<?php
namespace app\modules\probank;

use yii\base\BootstrapInterface;

class BootstrapFrontend implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {

        if( $app->id === "app-frontend"){

            $app->getUrlManager()->addRules(
                [
                    // объявление правил здесь
                    ''                                                                        => 'project/front/index',
                    '<page:\d+>'                                                              => 'project/front/index',
                    '<date:[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])>'            => 'project/front/date',
                    '<date:[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])>/<page:\d+>' => 'project/front/date',
                    'past'                                                                    => 'project/front/past',
                    'past/<page:\d+>'                                                         => 'project/front/index',
                    'search'                                                                  => 'project/front/search',
                    '<action:\w+>/<id:\d+>'                                                   => 'project/site/<action>',
                    '<action:[\w\-]+>'                                                        => 'project/site/<action>',
                ]
            );
        }
    }
}