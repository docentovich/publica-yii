<?php

namespace app\modules\tosee;

use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap ( $app )
    {
        $app->urlManagerFrontEnd->addRules(Urls::$frontUrls);
    }
}