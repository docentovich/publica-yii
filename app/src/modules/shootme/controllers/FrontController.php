<?php

namespace shootme\controllers;

use app\models\City;
use app\models\Comments;
use app\dto\ImagesServiceConfig;
use app\dto\ImagesTransportModel;
use app\services\BaseImagesService;
use shootme\dto\ShootmeSpecialistsServiceConfig;
use shootme\dto\ShootmeSpecialistsTransportModel;
use shootme\services\ShootmeSpecialistsService;
use app\traits\AjaxValidationTrait;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Cookie;

/**
 * Default controller for the `shootme` module
 */
class FrontController extends Controller
{
    use AjaxValidationTrait;
    public $layout = "@current_template/layouts/main";
    /** @var ShootmeSpecialistsService */
    protected $specialistsService;
    /** @var \app\services\BaseImagesService */
    protected $imagesService;

    public function setSpecialistsService($specialistsService)
    {
        $this->specialistsService = $specialistsService;
    }
    public function getSpecialistsService()
    {
        return $this->specialistsService;
    }

    public function setImagesService($imagesService)
    {
        $this->imagesService = $imagesService;
    }

    public function getImagesService()
    {
        return $this->imagesService;
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

    private function getTransportModel($config): ShootmeSpecialistsTransportModel
    {
        return $this->specialistsService->action(new ShootmeSpecialistsServiceConfig($config));
    }

    /**
     * @param int $page
     * @return string
     */
    public function actionIndex($page = 1)
    {
        if(\Yii::$app->request->post('filter')){
            \Yii::$app->response->cookies->add(new  Cookie([
                'name'  => 'city_id',
                'value' => \Yii::$app->request->post('city')
            ]));

            \Yii::$app->response->cookies->add(new  Cookie([
                'name'  => 'date',
                'value' => \Yii::$app->request->post('date')
            ]));

            \Yii::$app->response->cookies->add(new  Cookie([
                'name'  => 'time',
                'value' => \Yii::$app->request->post('time')
            ]));

            $this->redirect(['front/members']);
            \Yii::$app->end();
        }
        return $this->render('index', [
            'cities' =>  City::find()->all()
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
            'action' => ShootmeSpecialistsService::ACTION_GET_FILTERED_BY_TYPE_SPECIALISTS,
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
            'action' => ShootmeSpecialistsService::ACTION_GET_BY_ID,
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
            'action' => ShootmeSpecialistsService::ACTION_GET_FILTERED_BY_KEYWORD,
        ]);
        return $transportModel->result;
    }



    /**
     * @return array
     * @throws \Throwable
     */
    public function actionLike()
    {
        if (!\Yii::$app->request->isAjax) {
            throw new \Exception('request mast be ajax');
        }

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $data = \Yii::$app->request->post();

        /** @var ImagesTransportModel  */
        $transportModel = $this->imagesService->action(
            new ImagesServiceConfig([
                'action' => BaseImagesService::ACTION_LIKE,
                'user_id' => \Yii::$app->user->getId(),
                'id' => $data['image_id']
            ])
        );


        return [
            'action' => $transportModel->result['action'],
        ];
    }

    /**
     * @return mixed
     * @throws \Throwable
     */
    public function actionComment()
    {
        if (!\Yii::$app->request->isAjax) {
            throw new \Exception('request mast be ajax');
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $comment = new Comments();
        $comment->load(\Yii::$app->request->post());

        /** @var ImagesTransportModel $transportModel */
        $transportModel = $this->imagesService->action(
            new ImagesServiceConfig([
                'action' => BaseImagesService::ACTION_COMMENT,
                'comment' => $comment
            ])
        );

        return $transportModel->result;
    }

}
