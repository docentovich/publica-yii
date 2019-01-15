<?php

namespace publica\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Default controller for the `publica` module
 */
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
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?', '@'],
                    ]
                ],
            ],
        ];
    }

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


    /**
     * Экшен вывода постов по условиям
     *
     * @param int $page
     * @return string
     * @throws \Throwable
     * @throws \yii\base\ExitException
     */
    public function actionIndex($page = 1)
    {
        return $this->render('index');
    }

}
