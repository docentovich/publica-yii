<?php

namespace probank\controllers;

use probank\dto\ProbankSpecialistsServiceConfig;
use probank\dto\ProbankSpecialistsTransportModel;
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

    private function getTransportModel($config): ProbankSpecialistsTransportModel
    {
        return $this->specialistsService->action(new ProbankSpecialistsServiceConfig($config));
    }

    public function actionDateTime($portfolio_id)
    {
        $transportModel = $this->getTransportModel([
            'action' => ProbankSpecialistsService::ACTION_GET_BY_ID,
            'portfolio_id' => (int) $portfolio_id
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