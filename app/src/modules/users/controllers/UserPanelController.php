<?php

namespace users\controllers;

use yii\web\Controller;

abstract class UserPanelController extends Controller
{
    public $layout = "@current_template/layouts/user";

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
}