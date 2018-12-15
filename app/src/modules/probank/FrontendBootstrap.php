<?php
namespace app\modules\probank;

use yii\base\BootstrapInterface;

class FrontendBootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {

        if( $app->id === "app-frontend"){

            $app->getUrlManager()->addRules(
                [
                    ''                       => 'project/front/index',
                    'search'                 => 'project/front/search',
                    '<action:\w+>/<id:\d+>'  => 'project/site/<action>',
                    '<action:[\w\-]+>'       => 'project/site/<action>',
                ]
            );
        }
    }
}