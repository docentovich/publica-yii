<?php

namespace app\modules\tosee\controllers;


use yii\web\Controller;

class FrontController extends Controller
{
    /**
     * Задаем лайоут
     *
     * @var string
     */
    public $layout = "@current_template/layouts/main";
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }
}