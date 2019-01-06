<?php

namespace users\controllers;

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
                'class' => AccessControl::class,
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