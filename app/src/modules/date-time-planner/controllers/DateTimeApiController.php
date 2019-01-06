<?php

namespace DateTimePlanner\controllers;

use DateTimePlanner\models\DateTimePlanner;
use yii\filters\AccessControl;
use yii\web\Controller;

class DateTimeApiController extends Controller
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
                        'roles' => ['@', '?'],
                    ]
                ],
            ],
        ];
    }

    public function actionGetBusy()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return ['0-2', '6-8'];
    }
}