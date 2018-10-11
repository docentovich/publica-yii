<?php

namespace templates;

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
//                \Yii::$app->view->logoRelativeSrc = "/images/logos/tosee.png";
                require_once "frontend/probank/FrontendAsset.php";
                require_once "frontend/probank/FrontendAssetIE9.php";
                break;

            case TOSEE:
                require_once "frontend/tosee/FrontendAsset.php";
                require_once "frontend/tosee/FrontendAssetIE9.php";
                \Yii::$app->view->logoRelativeSrc = "/images/logos/probank.png";
                break;
        }
//        \Yii::setAlias('@current_template', __DIR__ . "/frontend/tosee_probank" );



    }
}
