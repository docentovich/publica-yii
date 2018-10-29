<?php

namespace app\assets;

use app\constants\Constants;
use yii\web\AssetBundle;

class DatePickerAsset extends AssetBundle
{
    public $sourcePath;
    public $js = [
        'datepicker.js'
    ];

    public function __construct(array $config = [])
    {
        $this->js[] = (\Yii::$app->language === Constants::LANGUAGE_RU)
            ? 'datepicker-ru.js'
            : 'datepicker-en.js';
        parent::__construct($config);
    }
}