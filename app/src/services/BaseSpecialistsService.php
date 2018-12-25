<?php

namespace app\services;

use app\abstractions\Services;
use app\dto\ConfigQuery;
use app\dto\SpecialistsConfigQuery;
use app\dto\SpecialistsServiceConfig;
use app\dto\SpecialistsTransportModel;
use app\models\Image;
use app\models\Portfolio;
use app\models\PortfolioAdditionalImages;
use app\traits\AjaxValidationTrait;
use ImageAjaxUpload\UploadDTO;
use ImageAjaxUpload\UploadModel;

class BaseSpecialistsService extends Services
{
    use AjaxValidationTrait;

    const ACTION_GET_ALL_SPECIALISTS = 1;
    const ACTION_GET_FILTERED_BY_TYPE_SPECIALISTS = 2;
    const ACTION_GET_BY_ID = 3;
    const ACTION_PORTFOLIO = 4;
    const ACTION_GET_FILTERED_BY_KEYWORD = 5;

    /** @var BaseSearchService BaseSearchService  */
    private $searchService;

    public function __construct(array $config = [], BaseSearchService $searchService)
    {
        $this->searchService = $searchService;
        parent::__construct($config);
    }
    /**
     * @param SpecialistsServiceConfig $config
     * @return SpecialistsTransportModel
     */
    public function action(\app\interfaces\config $config): \app\dto\TransportModel
    {
        switch ($config->action) {
            case self::ACTION_GET_ALL_SPECIALISTS:
                return $this->actionAllSpecialists($config);
            case self::ACTION_GET_FILTERED_BY_TYPE_SPECIALISTS:
                return $this->actionFilteredByTypeSpecialists($config);
            case self::ACTION_GET_FILTERED_BY_KEYWORD:
                return $this->actionSpecialistsByKeyword($config);
            case self::ACTION_GET_BY_ID:
                return $this->actionGetByID($config);
            case self::ACTION_PORTFOLIO:
                return $this->actionPortfolio($config);
        }
    }


    /**
     * @param SpecialistsServiceConfig $config
     * @return SpecialistsTransportModel
     */
    protected function actionAllSpecialists(SpecialistsServiceConfig $config)
    {
        $portfolioModel = Portfolio::find()->city(\Yii::$app->request->cookies->getValue('city_id'));
        return new SpecialistsTransportModel(
            new SpecialistsConfigQuery($config, $portfolioModel),
            $portfolioModel->all()
        );
    }

    /**
     * @param SpecialistsServiceConfig $config
     * @return SpecialistsTransportModel
     */
    protected function actionFilteredByTypeSpecialists(SpecialistsServiceConfig $config)
    {
        $portfolioModel = Portfolio::find()
            ->city(\Yii::$app->request->cookies->getValue('city_id'))
            ->type($config->type)->orderBy('modified_at');
        return new SpecialistsTransportModel(
            new SpecialistsConfigQuery($config, $portfolioModel),
            $portfolioModel->all()
        );
    }

    /**
     * @param SpecialistsServiceConfig $config
     * @return SpecialistsTransportModel
     */
    protected function actionGetByID(SpecialistsServiceConfig $config)
    {
        $portfolioModel = Portfolio::find()->where(['=', 'id', $config->id]);
        return new SpecialistsTransportModel(
            new SpecialistsConfigQuery($config, $portfolioModel),
            $portfolioModel->one()
        );
    }


    protected function actionPortfolio(SpecialistsServiceConfig $config)
    {
        $portfolio = Portfolio::findOne([
                'user_id' => \Yii::$app->user->getId(),
                'type' => $config->type
            ]) ?? new Portfolio(['type' => $config->type]);
        $portfolio->setScenario(Portfolio::SCENARIO_UPDATE);
        $this->performAjaxValidation($portfolio);

        if ($portfolio->load(\Yii::$app->request->post()) && $portfolio->validate() && $portfolio->save()) {
            $this->saveMainPhoto($portfolio);

            // additional portfolio images
            $this->saveAdditionalPhoto(
                $portfolio,
                (new UploadModel(['instance' => 1]))->multiUpload(\Yii::$app->user->getId()),
                PortfolioAdditionalImages::TYPE_PORTFOLIO
            );

//            if($config->type === Portfolio::PORTFOLIO_MODEL_TYPE){ // snaps
//                $this->saveAdditionalPhoto(
//                    $portfolio,
//                    (new UploadModel(['instance' => 2]))->multiUpload(\Yii::$app->user->getId()),
//                    PortfolioAdditionalImages::TYPE_SNAP
//                );
//            }

            \Yii::$app->response->refresh();
            \Yii::$app->end();
        }

        return new SpecialistsTransportModel(
            new SpecialistsConfigQuery($config),
            $portfolio
        );
    }


    protected function actionSpecialistsByKeyword(SpecialistsServiceConfig $config): SpecialistsTransportModel
    {
        $config->keyword = \Yii::$app->request->get('keyword');

        /** @var ConfigQuery $configQuery */
        $configQuery = new ConfigQuery(
            $config,
            Portfolio::find()
                ->city(\Yii::$app->request->cookies->getValue('city_id'))
                ->keyword($config->keyword)
        );

        return SpecialistsTransportModel::build(
            $this->searchService->search($configQuery, '/project/front-specialists/specialist')
        );
    }

    private function saveMainPhoto(Portfolio $portfolio)
    {
        // main image. get current, replace bay load, save, link
        $main_image = $portfolio->mainPhotoNN;
        $main_image->load(
            (new UploadModel())->upload(\Yii::$app->user->getId())->toArray(), ''
        );
        if ($main_image->validate()) {
            $main_image->save();
            $portfolio->link('mainPhoto', $main_image);
        }
    }

    private function saveAdditionalPhoto(Portfolio $portfolio, array $images, $type)
    {
        if (in_array($type, PortfolioAdditionalImages::ALLOWED_TYPES) === FALSE) {
            throw new \Exception(
                'type of additional image mast be in range of [' .
                implode(', ', PortfolioAdditionalImages::ALLOWED_TYPES
                    . ']'));
        }
        array_map(
            function ($item) use ($portfolio, $type) {
                /** @var UploadDTO $item */
                $image = new Image();
                $image->load($item->toArray(), '');
                if ($image->validate() && $image->save()) {
                    $portfolio->link('additionalImages', $image, ['type' => $type]);
                }
            },
            $images
        );
    }
}