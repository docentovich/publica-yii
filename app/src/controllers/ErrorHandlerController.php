<?php

namespace app\controllers;

use yii\web\Controller;

class ErrorHandlerController extends Controller
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

   public function init()
   {
       if(\Yii::$app->id === 'app-backend'){
           $this->layout = "@templates/userPanel/layouts/user";
       }
       parent::init();
   }
}