<?php

namespace app\modules\users\controllers;

use yii\filters\AccessControl;

class CommentsController extends UserPanelController
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
                        'actions' => ['comment-pic'],
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                ],
            ],
        ];
    }

    public function actionCommentPic($image_id)
    {

    }
    public function actionShowPicComments($image_id)
    {

    }
}