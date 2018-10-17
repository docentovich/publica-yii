<?php

namespace app\modules\probank;

/**
 * probank module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\probank\controllers\frontend';

    /**
     * @var boolean Если модуль используется для админ-панели.
     */
    public $isBackend;

    public $logoSrc = "probank.png";

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // Это здесь для того, чтобы переключаться между frontend и backend
        if ( \Yii::$app->id === "app-backend" ) {
            $this->controllerNamespace = 'app\modules\probank\controllers\backend';
            $this->setViewPath('@modules/probank/html/backend/views');
        } else {
            $this->setViewPath('@modules/probank/html/frontend/views');
        }
    }
}