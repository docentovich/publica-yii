<?php

namespace app\modules\probank\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\modules\probank\services\frontend\postService as Post;
use yii\web\Cookie;
use yii\web\HttpException;

/**
 * Default controller for the `probank` module
 */
class FrontController extends Controller
{
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
                        'actions' => ['like', 'comment'],
                        'allow' => true,
                        'roles' => ['@'],
                    ], [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?', '@'],
                    ]
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
        \Yii::$app->postService->action(
            new PostServiceConfig($config)
        );
        return $this->render('index', [
            "specialistModel" => $this->getPostTransportModel(['action' => ToseePostService::ACTION_FUTURE])
        ]);
    }

}
