<?php

namespace DateTimePlanner\controllers;

use DateTimePlanner\models\DateTimePlanner;
use DateTimePlanner\models\DateTimePlannerForm;
use yii\base\InvalidArgumentException;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\web\Controller;

class DateTimeApiController extends Controller
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
                        'allow' => true,
                        'roles' => ['@', '?'],
                    ]
                ],
            ],
        ];
    }

    /**
     * @param $user_id
     * @return array
     * @throws \Exception
     */
    public function actionGetBusy($user_id = null)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $date = \Yii::$app->request->post('date');
        if (\DateTime::createFromFormat('Y-m-d', $date) === FALSE) {
            throw new \Exception('not proper date format');
        }

        if ($user_id === null && ($user_id = \Yii::$app->user->getId()) === null) {
            return [];
        }

        $result = DateTimePlanner::find()->date($date)->user($user_id)->all();
        return array_map(function ($row) {
            /** @var DateTimePlanner $row */
            return $row->time;
        }, $result);
    }

    /**
     * @param null $user_id
     * @return array
     */
    public function actionSave($user_id = null)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if ($user_id === null && ($user_id = \Yii::$app->user->getId()) === null) {
            throw new InvalidArgumentException('You must be logged or request some "user_id"');
        }
        ($form_model = new DateTimePlannerForm())->load(\Yii::$app->request->post());

        if (!$form_model->validate()) {
            return [
                'message' => $form_model->getFirstError(),
                'code' => 100,
            ];
        }

        $date = $form_model->date;
        array_map(function ($time) use ($user_id, $date) {
            $model = new DateTimePlanner(['user_id' => $user_id, 'date' => $date, 'time' => $time]);
            if ($model->validate()) {
                $model->save();
            }
        }, $form_model->time);

        return [];
    }
}