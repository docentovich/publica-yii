<?php

namespace app\modules\probank\controllers;

use app\dto\SpecialistsServiceConfig;
use app\modules\probank\models\ProbankPortfolio;
use app\modules\probank\services\ProbankSpecialistsService;
use app\services\BaseSpecialistsService;
use app\traits\AjaxValidationTrait;
use yii\base\Module;
use yii\filters\AccessControl;
use yii\web\Controller;

class PhotographerController extends Controller
{
    use AjaxValidationTrait;

    public $layout = "@current_template/layouts/user";
    /** @var BaseSpecialistsService  */
    private $specialistsService;

    public function __construct(string $id,
                                Module $module,
                                array $config = [],
                                BaseSpecialistsService $specialistsService)
    {
        $this->specialistsService = $specialistsService;
        parent::__construct($id, $module, $config);
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
            new SpecialistsServiceConfig([
                'action' => ProbankSpecialistsService::ACTION_PORTFOLIO,
                'type' => ProbankPortfolio::PORTFOLIO_PHOTOGRAPHER_TYPE
            ])
        );
        return $this->render('portfolio', [
            'model' => $transportModel->result
        ]);
    }
}