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
                require_once "probank/Asset.php";
                require_once "probank/AssetIE9.php";
                \Yii::setAlias('@current_template', __DIR__ . "/probank" );
                break;

            case TOSEE:
                require_once "tosee/Asset.php";
                require_once "tosee/AssetIE9.php";
                \Yii::setAlias('@current_template', __DIR__ . "/tosee" );
                break;
        }
    }
}
