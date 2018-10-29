<?php

namespace app\widgets\header;

use yii\base\Widget;
use yii\web\AssetBundle;

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

        return $this->render("view", [
            "content" => $content,
            "currentProject" => $this->project,
            "projects" => [
                self::PROJECT_PUBLICA,
                self::PROJECT_TOSEE,
                self::PROJECT_PROBANK,
                self::PROJECT_SHOOTME,
            ]
        ]);
    }
}