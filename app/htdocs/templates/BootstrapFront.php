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
        
        // switch ( \Yii::$app->params[ 'project' ]  )
        // {
        //     case PROBANK:
        //         \Yii::$app->view->logoRelativeSrc = "/images/logos/tosee.png";
        //         break;
        //
        //     case TOSEE:
        //         \Yii::$app->view->logoRelativeSrc = "/images/logos/probank.png";
        //         break;
        // }
    
        \Yii::setAlias('@current_template', __DIR__ . "/frontend/tosee_probank" );
    
    
        require_once "frontend/tosee_probank/FrontendAsset.php";
        require_once "frontend/tosee_probank/FrontendAssetIE9.php";
        
    }
}
