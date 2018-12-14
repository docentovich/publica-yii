<?php

namespace app\modules\tosee;

use yii\base\BootstrapInterface;

class FrontendBootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap ( $app )
    {
        if( $app->id === "app-frontend"){
            $app->getUrlManager()->addRules(Urls::$frontUrls);
        }
    }
}