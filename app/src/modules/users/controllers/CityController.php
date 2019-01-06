<?php

namespace users\controllers;

use users\models\UsersCity;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Cookie;

class CityController extends Controller
{
    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    ['allow' => true],
                ],
            ],
        ];
    }

    public function actionSetCity($id)
    {
        if(UsersCity::findOne(["id" => $id]) === null){
            throw new \Exception('incorrect city', 405);
        }

        \Yii::$app->response->cookies->add(new  Cookie([
            'name' => 'city_id',
            'value' => $id
        ]));

        \Yii::$app->response->redirect(\Yii::$app->request->get('back'));
        \Yii::$app->end();
    }
}