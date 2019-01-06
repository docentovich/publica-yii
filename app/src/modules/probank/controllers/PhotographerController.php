<?php

namespace probank\controllers;

use probank\dto\ProbankSpecialistsServiceConfig;
use probank\models\ProbankPortfolio;
use probank\services\ProbankSpecialistsService;
use app\traits\AjaxValidationTrait;
use yii\filters\AccessControl;
use yii\web\Controller;

class PhotographerController extends Controller
{
    use AjaxValidationTrait;

    public $layout = "@current_template/layouts/user";
    /** @var ProbankSpecialistsService  */
    protected $specialistsService;

    public function  setSpecialistsService($specialistsService)
    {
        $this->specialistsService = $specialistsService;
    }

    public function  getSpecialistsService()
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
                        'roles' => ['photograph'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionPortfolio()
    {
        $transportModel = $this->specialistsService->action(
            new ProbankSpecialistsServiceConfig([
                'action' => ProbankSpecialistsService::ACTION_PORTFOLIO,
                'type' => ProbankPortfolio::PORTFOLIO_PHOTOGRAPHER_TYPE
            ])
        );
        return $this->render('portfolio', [
            'model' => $transportModel->result
        ]);
    }
}