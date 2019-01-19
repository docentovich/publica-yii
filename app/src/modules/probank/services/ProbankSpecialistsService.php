<?php

namespace probank\services;

use app\services\BaseSpecialistsService;
use app\dto\ConfigQuery;
use probank\dto\ProbankSpecialistsConfigQuery;
use probank\dto\ProbankSpecialistsServiceConfig;
use probank\dto\ProbankSpecialistsTransportModel;
use app\traits\AjaxValidationTrait;
use ImageAjaxUpload\UploadDTO;
use ImageAjaxUpload\UploadModel;
use probank\models\ProbankImages;
use probank\models\ProbankPortfolio;
use probank\models\ProbankPortfolioAdditionalImages;

class ProbankSpecialistsService extends BaseSpecialistsService
{
    use AjaxValidationTrait;

    const ACTION_GET_ALL_SPECIALISTS = 1;
    const ACTION_GET_FILTERED_BY_TYPE_SPECIALISTS = 2;
    const ACTION_GET_BY_ID = 3;
    const ACTION_PORTFOLIO = 4;
    const ACTION_GET_FILTERED_BY_KEYWORD = 5;

    /** @var \app\services\BaseSearchService   */
    protected $searchService;

    public function setSearchService($searchService)
    {
        $this->searchService = $searchService;
    }

    public function getSearchService()
    {
        return $this->searchService;
    }

    /**
     * @param ProbankSpecialistsServiceConfig $config
     * @return ProbankSpecialistsTransportModel
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
     * @param ProbankSpecialistsServiceConfig $config
     * @return ProbankSpecialistsTransportModel
     */
    protected function actionAllSpecialists(ProbankSpecialistsServiceConfig $config)
    {
        $portfolioModel = ProbankPortfolio::find()->city(\app\models\City::getCurrentCityId())->orderBy(['id' => SORT_ASC]);
        return new ProbankSpecialistsTransportModel(
            new ProbankSpecialistsConfigQuery($config, $portfolioModel),
            $portfolioModel->all()
        );
    }

    /**
     * @param ProbankSpecialistsServiceConfig $config
     * @return ProbankSpecialistsTransportModel
     */
    protected function actionFilteredByTypeSpecialists(ProbankSpecialistsServiceConfig $config)
    {
        $portfolioModel = ProbankPortfolio::find()
            ->city(\app\models\City::getCurrentCityId())
            ->type($config->type)->orderBy('modified_at')
            ->orderBy(['id' => SORT_ASC]);
        return new ProbankSpecialistsTransportModel(
            new ProbankSpecialistsConfigQuery($config, $portfolioModel),
            $portfolioModel->all()
        );
    }

    /**
     * @param ProbankSpecialistsServiceConfig $config
     * @return ProbankSpecialistsTransportModel
     */
    protected function actionGetByID(ProbankSpecialistsServiceConfig $config)
    {
        $portfolioModel = ProbankPortfolio::find()->where(['=', 'id', $config->portfolio_id]);
        return new ProbankSpecialistsTransportModel(
            new ProbankSpecialistsConfigQuery($config, $portfolioModel),
            $portfolioModel->one()
        );
    }


    /**
     * Get/Save Specialist portfolio
     *
     * @param ProbankSpecialistsServiceConfig $config
     * @return ProbankSpecialistsTransportModel
     * @throws \yii\base\ExitException
     */
    protected function actionPortfolio(ProbankSpecialistsServiceConfig $config)
    {
        $portfolio = ProbankPortfolio::findOne([
                'user_id' => \Yii::$app->user->getId(),
                'type' => $config->type
            ]) ?? new ProbankPortfolio(['type' => $config->type]);
        $portfolio->setScenario(ProbankPortfolio::SCENARIO_UPDATE);
        $this->performAjaxValidation($portfolio);

        if ($portfolio->load(\Yii::$app->request->post()) && $portfolio->validate() && $portfolio->save()) {
            $this->saveMainPhoto($portfolio);

            // additional portfolio images
            $this->saveAdditionalPhoto(
                $portfolio,
                (new UploadModel(['instance' => 1]))->multiUpload(\Yii::$app->user->getId()),
                ProbankPortfolioAdditionalImages::TYPE_PORTFOLIO
            );

//            if($config->type === ProbankPortfolio::PORTFOLIO_MODEL_TYPE){ // snaps
//                $this->saveAdditionalPhoto(
//                    $portfolio,
//                    (new UploadModel(['instance' => 2]))->multiUpload(\Yii::$app->user->getId()),
//                    ProbankPortfolioAdditionalImages::TYPE_SNAP
//                );
//            }

            \Yii::$app->response->refresh();
            \Yii::$app->end();
        }

        return new ProbankSpecialistsTransportModel(
            new ProbankSpecialistsConfigQuery($config),
            $portfolio
        );
    }


    /**
     * Search Portfolio
     *
     * @param ProbankSpecialistsServiceConfig $config
     * @return ProbankSpecialistsTransportModel
     * @throws \Exception
     */
    protected function actionSpecialistsByKeyword(ProbankSpecialistsServiceConfig $config): ProbankSpecialistsTransportModel
    {
        $config->keyword = \Yii::$app->request->get('keyword');

        /** @var ConfigQuery $configQuery */
        $configQuery = new ConfigQuery(
            $config,
            ProbankPortfolio::find()
                ->city(\app\models\City::getCurrentCityId())
                ->keyword($config->keyword)
        );

        return ProbankSpecialistsTransportModel::build(
            $this->searchService->search($configQuery, '/project/front-specialists/specialist')
        );
    }

    /**
     * Save Main Photo
     *
     * @param ProbankPortfolio $portfolio
     */
    private function saveMainPhoto(ProbankPortfolio $portfolio)
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

    /**
     * Save Additional Photo
     *
     * @param ProbankPortfolio $portfolio
     * @param array $images
     * @param $type
     * @throws \Exception
     */
    private function saveAdditionalPhoto(ProbankPortfolio $portfolio, array $images, $type)
    {
        if (in_array($type, ProbankPortfolioAdditionalImages::ALLOWED_TYPES) === FALSE) {
            throw new \Exception(
                'type of additional image mast be in range of [' .
                implode(', ', ProbankPortfolioAdditionalImages::ALLOWED_TYPES
                    . ']'));
        }
        array_map(
            function ($item) use ($portfolio, $type) {
                /** @var UploadDTO $item */
                $image = new ProbankImages();
                $image->load($item->toArray(), '');
                if ($image->validate() && $image->save()) {
                    $portfolio->link('additionalImages', $image, ['type' => $type]);
                }
            },
            $images
        );
    }
}