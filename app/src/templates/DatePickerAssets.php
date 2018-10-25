<?php
/**
 * Created by PhpStorm.
 * User: AProzorov
 * Date: 25.10.2018
 * Time: 13:35
 */

namespace app\templates;


use app\constants\Constants;
use yii\web\AssetBundle;

class DatePickerAssets extends AssetBundle
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