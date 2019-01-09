<?php

namespace probank\controllers;

use probank\dto\OrdersServiceConfig;
use probank\dto\OrdersTransportModel;
use probank\services\ProbankSpecialistsService;
use yii\filters\AccessControl;
use yii\web\Controller;

class OrdersController extends Controller
{
    public $layout = "@current_template/layouts/main";

    /** @var ProbankSpecialistsService */
    protected $specialistsService;

    public function setSpecialistsService($specialistsService)
    {
        $this->specialistsService = $specialistsService;
    }

    public function getSpecialistsService()
    {
        return $this->specialistsService;
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
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                ],
            ],
        ];
    }

    private function getTransportModel($config): OrdersTransportModel
    {
        return $this->specialistsService->action(new OrdersServiceConfig($config));
    }

    public function actionDateTime($sellers_id)
    {
        $transportModel = $this->getTransportModel([
            'action' => ProbankSpecialistsService::ACTION_GET_BY_ID,
            'id' => (int) $sellers_id
        ]);
        return $this->render('date-time', [
            'specialistTransportModel' => $transportModel,
        ]);
    }

    public function actionComplete($sellers_id)
    {

    }

    public function actionRate($sellers_id)
    {

    }

    public function actionProcess($sellers_id)
    {

    }

    public function actionSalesOf($sellers_id)
    {

    }
}