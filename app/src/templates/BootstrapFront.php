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
                \Yii::setAlias('@current_template', __DIR__ . "/probank" );
                break;

            case TOSEE:
                \Yii::setAlias('@current_template', __DIR__ . "/tosee" );
                break;

            case PUBLICA:
                \Yii::setAlias('@current_template', __DIR__ . "/publica" );
                break;

            case SHOOTME:
                \Yii::setAlias('@current_template', __DIR__ . "/shootme" );
                break;
        }
    }
}
