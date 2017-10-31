<?php
namespace templates;

use yii\base\BootstrapInterface;

class BootstrapBAckend implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap( $app )
    {
        
        \Yii::setAlias('@current_template', __DIR__ . "/backend/main" );
        
    }
}
