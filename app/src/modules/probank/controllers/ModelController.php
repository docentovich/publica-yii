<?php

namespace app\modules\probank\controllers;

use yii\web\Controller;

class ModelController extends Controller
{
    public $layout = "@current_template/layouts/main";

    public function actionIndex()
    {
        return $this->render('index');
    }
}