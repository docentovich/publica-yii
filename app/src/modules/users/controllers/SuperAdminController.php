<?php

namespace users\controllers;

use users\models\SuperAdminModel;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\web\Controller;

abstract class SuperAdminController extends Controller
{
    public $layout = "@current_template/layouts/super-admin";

    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['administrator'],
                    ],
                ],
            ],
        ];
    }

    abstract protected function getModel($params = []): SuperAdminModel;

    public function actionIndex()
    {
        $model = $this->getModel(['scenario' => 'update']);
        if($model->load(\Yii::$app->request->post()) && $model->save()){
            $this->refresh();
        }
        return $this->render('all', ['results' => $this->getModel()->find()->all()]);
    }

    public function actionShowSingle($id)
    {
        if(!empty($post = \Yii::$app->request->post()) && in_array(['approve', 'ban', 'delete'], $post['action'])) {
            $model = $this->getModel(['id' => $id]);
            if( $model->{$post['action']}() ){
                $this->refresh();
            }
        }
        return $this->render('single', ['results' => $this->getModel()->find()->one()]);
    }

}