<?php

namespace modules\tosee;

use yii\base\BootstrapInterface;

class FrontendBootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap ( $app )
    {
        if( $app->id === "app-frontend"){

            $app->getUrlManager()->addRules(
                [
                    // объявление правил здесь
                    ''                                                                        => 'project/site/index',
                    '<page:\d+>'                                                              => 'project/site/index',
                    '<date:[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])>'            => 'project/site/date',
                    '<date:[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])>/<page:\d+>' => 'project/site/date',
                    'past'                                                                    => 'project/site/past',
                    'past/<page:\d+>'                                                         => 'project/site/index',
                    'search'                                                                  => 'project/site/search',
                    '<action:\w+>/<id:\d+>'                                                   => 'project/site/<action>',
                    '<action:[\w\-]+>'                                                        => 'project/site/<action>',
                ]
            );
        }
    }
}