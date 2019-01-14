<?php

namespace publica\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

class FrontController extends Controller
{
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
                    ],
                ],
            ],
        ];
    }



    /**
     * @param int $page
     * @return string
     */
    public function actionIndex($page = 1)
    {
        return $this->render('index');
    }


}
