<?php

namespace app\modules\probank\controllers;

use yii\web\Controller;

class PhotographerController extends Controller
{
    public $layout = "@current_template/layouts/user";

    public function actionIndex()
    {
        return $this->render('index');
    }
}