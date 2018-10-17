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
                require_once "frontend/probank/FrontendAsset.php";
                require_once "frontend/probank/FrontendAssetIE9.php";
                \Yii::setAlias('@current_template', __DIR__ . "/frontend/probank" );
                break;

            case TOSEE:
                require_once "frontend/tosee/FrontendAsset.php";
                require_once "frontend/tosee/FrontendAssetIE9.php";
                \Yii::setAlias('@current_template', __DIR__ . "/frontend/tosee" );
                break;
        }
    }
}
