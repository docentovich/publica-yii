<?php

namespace app\modules\users\controllers;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class CalendarController extends UserPanelController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'occupy' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['show', 'occupy'],
                        'allow' => true,
                        'roles' => ['model', 'photograph'],
                    ],
                ],
            ],
        ];
    }

    public function actionShow()
    {

    }

    public function actionOccupy()
    {
        
    }
}