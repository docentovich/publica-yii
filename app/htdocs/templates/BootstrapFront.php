<?php
namespace templates;

use yii\base\BootstrapInterface;

class BootstrapFront implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap( $app )
    {
        
        switch ( \Yii::$app->params[ 'project' ]  )
        {
            case PROBANK:
            case TOSEE:
                \Yii::setAlias('@current_template', __DIR__ . "/frontend/tosee_probank" );
                break;
        }
        
        require_once "frontend/tosee_probank/FrontendAsset.php";
        require_once "frontend/tosee_probank/FrontendAssetIE9.php";
        
    }
}
