<?php

namespace app\widgets\header;

use app\models\City;
use yii\base\Widget;

/**
 * Самая врхняя плашечка
 *
 * Class Header
 * @package app\widgets\header
 */
class Header extends Widget
{
    const PROJECT_PUBLICA = 'publica';
    const PROJECT_TOSEE = 'publica';
    const PROJECT_PROBANK = 'publica';
    const PROJECT_SHOOTME = 'publica';
    /** @var string */
    public $project;

    public function init()
    {
        parent::init();
        ob_start();
    }

    public function run()
    {
        $content = ob_get_clean();
        $city_cookie =  \Yii::$app->request->cookies->getValue('city_id');
        $current_city = City::findOne(["id" => $city_cookie]);
        $current_city = $current_city ?? City::findDefault();

        return $this->render("view", [
            "content" => $content,
            "currentProject" => $this->project,
            "cities" => City::find()->all(),
            "current_city" => $current_city,
            "projects" => [
                self::PROJECT_PUBLICA,
                self::PROJECT_TOSEE,
                self::PROJECT_PROBANK,
                self::PROJECT_SHOOTME,
            ]
        ]);
    }
}