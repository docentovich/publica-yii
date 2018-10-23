<?php

namespace app\templates;

use yii\base\BootstrapInterface;

class BootstrapFront implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        switch (PROJECT) {
            case PROBANK:
                require_once "probank/FrontendAsset.php";
                require_once "probank/FrontendAssetIE9.php";
                \Yii::setAlias('@current_template', __DIR__ . "/probank" );
                break;

            case TOSEE:
                require_once "tosee/FrontendAsset.php";
                require_once "tosee/FrontendAssetIE9.php";
                \Yii::setAlias('@current_template', __DIR__ . "/tosee" );
                break;
        }
    }
}
