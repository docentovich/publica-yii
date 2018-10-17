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
        
        \Yii::setAlias('@current_template', __DIR__ . "/backend/main" );
    
        require_once "backend/main/BackendAsset.php";
    
    }
}
