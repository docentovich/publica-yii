<?php

namespace DateTimePlanner\controllers;

use DateTimePlanner\models\DateTimePlanner;
use yii\filters\AccessControl;
use yii\web\Controller;

class DateTimeController extends Controller
{
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
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index', ['model' => new DateTimePlanner()]);
    }
}