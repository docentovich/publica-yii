<?php

namespace probank\controllers;

use probank\dto\ProbankSpecialistsServiceConfig;
use probank\dto\ProbankSpecialistsTransportModel;
use probank\services\ProbankSpecialistsService;
use app\traits\AjaxValidationTrait;
use yii\base\Module;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Default controller for the `probank` module
 */
class FrontSpecialistsController extends Controller
{
    use AjaxValidationTrait;
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
                        'actions' => ['like', 'comment'],
                        'allow' => true,
                        'roles' => ['@'],
                    ], [
                        'actions' => ['index', 'specialist', 'type', 'search'],
                        'allow' => true,
                        'roles' => ['?', '@'],
                    ]
                ],
            ],
        ];
    }

    private function getTransportModel($config): ProbankSpecialistsTransportModel
    {
        return $this->specialistsService->action(new ProbankSpecialistsServiceConfig($config));
    }

    /**
     * @param int $page
     * @return string
     */
    public function actionIndex($page = 1)
    {
        $transportModel = $this->getTransportModel(
            ['action' => ProbankSpecialistsService::ACTION_GET_ALL_SPECIALISTS]
        );
        return $this->render('specialists', [
            'specialistTransportModel' => $transportModel,
        ]);
    }


    /**
     * Filter by type
     *
     * @param int $page
     * @return string
     */
    public function actionType($type, $page = 1)
    {
        $type = strtoupper($type);
        $transportModel = $this->getTransportModel([
            'action' => ProbankSpecialistsService::ACTION_GET_FILTERED_BY_TYPE_SPECIALISTS,
            'type' => $type
        ]);
        return $this->render('specialists', [
            'specialistTransportModel' => $transportModel,
        ]);
    }

    /**
     * Single specialist
     *
     * @param int $portfolio_id
     * @return string
     */
    public function actionSpecialist($portfolio_id)
    {
        $transportModel = $this->getTransportModel([
            'action' => ProbankSpecialistsService::ACTION_GET_BY_ID,
            'portfolio_id' => (int) $portfolio_id
        ]);
        return $this->render('specialist', [
            'specialistTransportModel' => $transportModel,
        ]);
    }

    /**
     * @return array
     * @throws \Throwable
     * @throws \yii\base\ExitException
     */
    public function actionSearch()
    {
        $transportModel = $this->getTransportModel([
            'action' => ProbankSpecialistsService::ACTION_GET_FILTERED_BY_KEYWORD,
        ]);
        return $transportModel->result;
    }

}
