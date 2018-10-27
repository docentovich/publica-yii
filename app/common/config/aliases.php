<?php

namespace common\config;

use yii\base\BootstrapInterface;

class Aliases implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        \Yii::setAlias('@common', dirname(__DIR__));
        \Yii::setAlias('@uploads', dirname(dirname(__DIR__)) . '/frontend/web/uploads');
        \Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
        \Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
        \Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
        \Yii::setAlias('@modules', dirname(dirname(__DIR__)) . '/src/modules');
        \Yii::setAlias('@src', dirname(dirname(__DIR__)) . '/src');
        \Yii::setAlias('@models', dirname(dirname(__DIR__)) . '/src/models');
        \Yii::setAlias('@components', dirname(dirname(__DIR__)) . '/src/components');
        \Yii::setAlias('@templates', dirname(dirname(__DIR__)) . '/src/templates');
    }
}
