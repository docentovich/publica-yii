<?php
namespace app\templates;

use yii\base\BootstrapInterface;

class BootstrapBackend implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap( $app )
    {
        \Yii::setAlias('@current_template', __DIR__ . "/userPanel" );
        require_once "userPanel/BackendAsset.php";
    }
}
