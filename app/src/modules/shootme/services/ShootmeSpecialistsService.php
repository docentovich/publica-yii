<?php

namespace shootme\services;

use app\models\Portfolio;
use app\models\PortfolioQuery;
use app\services\BaseSpecialistsService;
use app\dto\ConfigQuery;
use shootme\dto\ShootmeSpecialistsConfigQuery;
use shootme\dto\ShootmeSpecialistsServiceConfig;
use shootme\dto\ShootmeSpecialistsTransportModel;
use app\traits\AjaxValidationTrait;
use shootme\models\ShootmePortfolio;

class ShootmeSpecialistsService extends BaseSpecialistsService
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
     * @param ShootmeSpecialistsServiceConfig $config
     * @return ShootmeSpecialistsTransportModel
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
     * @param ShootmeSpecialistsServiceConfig $config
     * @return ShootmeSpecialistsTransportModel
     */
    protected function actionAllSpecialists(ShootmeSpecialistsServiceConfig $config)
    {
        $date = new \DateTime(\Yii::$app->request->cookies->getValue('date'));
        $time = \Yii::$app->request->cookies->getValue('time');
        $portfolioModel = ShootmePortfolio::find()
            ->type(Portfolio::PORTFOLIO_PHOTOGRAPHER_TYPE)
            ->freeDateTime($date, $time[0])
            ->city(\app\models\City::getCurrentCityId());

        return new ShootmeSpecialistsTransportModel(
            new ShootmeSpecialistsConfigQuery($config, $portfolioModel),
            $portfolioModel->all()
        );
    }

    /**
     * @param ShootmeSpecialistsServiceConfig $config
     * @return ShootmeSpecialistsTransportModel
     * @throws \Throwable
     */
    protected function actionGetByID(ShootmeSpecialistsServiceConfig $config)
    {
        $portfolioModel = ShootmePortfolio::find()->where(['=', 'id', $config->portfolio_id]);
        $result = $portfolioModel->one();

        $nextPortfolio = $this->siblingPortfolio('>', $result, $config);
        $prevPortfolio = $this->siblingPortfolio('<', $result, $config);

        return new ShootmeSpecialistsTransportModel(
            new ShootmeSpecialistsConfigQuery($config, $portfolioModel),
            $result,
            $prevPortfolio,
            $nextPortfolio
        );
    }


//    /**
//     * Get/Save Specialist portfolio
//     *
//     * @param ShootmeSpecialistsServiceConfig $config
//     * @return ShootmeSpecialistsTransportModel
//     * @throws \yii\base\ExitException
//     */
//    protected function actionPortfolio(ShootmeSpecialistsServiceConfig $config)
//    {
//        $portfolio = ShootmePortfolio::findOne([
//                'user_id' => \Yii::$app->user->getId(),
//                'type' => $config->type
//            ]) ?? new ShootmePortfolio(['type' => $config->type]);
//        $portfolio->setScenario(ShootmePortfolio::SCENARIO_UPDATE);
//        $this->performAjaxValidation($portfolio);
//
//        if ($portfolio->load(\Yii::$app->request->post()) && $portfolio->validate() && $portfolio->save()) {
//            $this->saveMainPhoto($portfolio);
//
//            // additional portfolio images
//            $this->saveAdditionalPhoto(
//                $portfolio,
//                (new UploadModel(['instance' => 1]))->multiUpload(\Yii::$app->user->getId()),
//                ShootmePortfolioAdditionalImages::TYPE_PORTFOLIO
//            );
//
////            if($config->type === ShootmePortfolio::PORTFOLIO_MODEL_TYPE){ // snaps
////                $this->saveAdditionalPhoto(
////                    $portfolio,
////                    (new UploadModel(['instance' => 2]))->multiUpload(\Yii::$app->user->getId()),
////                    ShootmePortfolioAdditionalImages::TYPE_SNAP
////                );
////            }
//
//            \Yii::$app->response->refresh();
//            \Yii::$app->end();
//        }
//
//        return new ShootmeSpecialistsTransportModel(
//            new ShootmeSpecialistsConfigQuery($config),
//            $portfolio
//        );
//    }


    /**
     * Search Portfolio
     *
     * @param ShootmeSpecialistsServiceConfig $config
     * @return ShootmeSpecialistsTransportModel
     * @throws \Exception
     */
    protected function actionSpecialistsByKeyword(ShootmeSpecialistsServiceConfig $config): ShootmeSpecialistsTransportModel
    {
        $config->keyword = \Yii::$app->request->get('keyword');

        /** @var ConfigQuery $configQuery */
        $configQuery = new ConfigQuery(
            $config,
            ShootmePortfolio::find()
                ->type(Portfolio::PORTFOLIO_PHOTOGRAPHER_TYPE)
                ->city(\app\models\City::getCurrentCityId())
                ->keyword($config->keyword)
        );

        return ShootmeSpecialistsTransportModel::build(
            $this->searchService->search($configQuery, '/project/front-specialists/specialist')
        );
    }

    /**`Helper`
     * Return the next or prev post
     *
     * @param string $compare
     * @param ShootmePortfolio $portfolio
     * @param ShootmeSpecialistsServiceConfig $config
     * @return ShootmePortfolio|null
     * @throws \Throwable
     */
    private function siblingPortfolio($compare, $portfolio, $config)
    {
        try {
            /** @var PortfolioQuery $query */
            $query = Portfolio::find()
                ->alias('portfolio')
                ->orderBy(['id' => ($compare === '>') ? SORT_ASC : SORT_DESC])
                ->andWhere([$compare, 'portfolio.id', $portfolio->id])
                ->currentCity();

            return $query->one();
        } catch (\Exception $e) {
            return null;
        }
    }
}