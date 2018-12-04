<?php

namespace app\assets;

use app\constants\Constants;
use yii\web\AssetBundle;

class DatePickerAsset extends AssetBundle
{
    public $sourcePath;
    public $js = [
        'div-datepicker.js'
    ];

    public function __construct(array $config = [])
    {
        $this->js[] = (\Yii::$app->language === Constants::LANGUAGE_RU)
            ? 'div-datepicker-ru.js'
            : 'div-datepicker-en.js';
        parent::__construct($config);
    }
}