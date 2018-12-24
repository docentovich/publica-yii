<?php

namespace app\modules\probank\controllers;

use app\dto\SpecialistsServiceConfig;
use app\dto\SpecialistsTransportModel;
use app\modules\probank\services\ProbankSpecialistsService;
use app\services\BaseSpecialistsService;
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
    /** @var BaseSpecialistsService */
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
                        'actions' => ['like', 'comment'],
                        'allow' => true,
                        'roles' => ['@'],
                    ], [
                        'actions' => ['index', 'specialist'],
                        'allow' => true,
                        'roles' => ['?', '@'],
                    ]
                ],
            ],
        ];
    }

    private function getTransportModel($config): SpecialistsTransportModel
    {
        return $this->specialistsService->action(new SpecialistsServiceConfig($config));
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
     * @param int $page
     * @return string
     */
    public function actionType($type, $page = 1)
    {
        $transportModel = $this->getTransportModel([
            'action' => ProbankSpecialistsService::ACTION_GET_FILTERED_BY_TYPE_SPECIALISTS,
            'type' => $type
        ]);
        return $this->render('specialists', [
            'specialistTransportModel' => $transportModel,
        ]);
    }


    public function actionSpecialist($id)
    {
        $transportModel = $this->getTransportModel([
            'action' => ProbankSpecialistsService::ACTION_GET_BY_ID,
            'id' => (int) $id
        ]);
        return $this->render('specialist', [
            'specialistTransportModel' => $transportModel,
        ]);
    }

}
