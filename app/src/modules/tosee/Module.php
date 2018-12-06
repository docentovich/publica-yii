<?php

namespace app\modules\tosee;

/**
 * tosee module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\tosee\controllers';

    /**
     * @var boolean Если модуль используется для админ-панели.
     */
    public $isBackend;

    public $logoSrc = "tosee.png";

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->controllerNamespace ;
    }
}