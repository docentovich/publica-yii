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
    public $controllerNamespace = 'app\modules\probank\controllers';

    /**
     * @var boolean Если модуль используется для админ-панели.
     */
    public $isBackend;

    public $logoSrc = "probank.png";

}