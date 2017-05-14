<?php

namespace modules\tosee;

/**
 * tosee module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'modules\tosee\controllers\frontend';

    /**
     * @var boolean Если модуль используется для админ-панели.
     */
    public $isBackend;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // Это здесь для того, чтобы переключаться между frontend и backend
        if ($this->isBackend === true) {
            $this->controllerNamespace = 'modules\tosee\controllers\backend';
            $this->setViewPath('@modules/tosee/views/backend');
        } else {
            $this->setViewPath('@modules/tosee/views/frontend');
        }
    }
}