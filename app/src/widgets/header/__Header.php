<?php
namespace app\widgets\header;

use yii\base\Widget;
use common\models\City;
use yii\helpers\ArrayHelper;

/**
 * Самая врхняя плашечка
 *
 * Class Header
 * @package app\widgets\header
 */
class Header extends Widget
{
    /**
     * @var string url логотипа плашки
     */
    public $logo;



    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $cities = City::find()->asArray()->all();
        $cities = ArrayHelper::map($cities, 'id', 'label');
        $current_city_id =  \Yii::$app->request->cookies->getValue("city_id");

        return $this->render("view", [
            "logo" => $this->logo,
            "cities" => $cities,
            "current_city_id" => $current_city_id
        ]);
    }
}