<?php

namespace app\modules\users\controllers;

use yii\filters\AccessControl;

class LikeController extends UserPanelController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['like-picture'],
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                ],
            ],
        ];
    }

    public function actionCountPictureLikes($image_id)
    {

    }

    public function actionLikePicture($image_id)
    {

    }
}