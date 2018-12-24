<?php

namespace app\services;

use app\abstractions\Services;
use app\dto\ConfigQuery;
use app\dto\SpecialistsConfigQuery;
use app\dto\SpecialistsServiceConfig;
use app\dto\SpecialistsTransportModel;
use app\models\Portfolio;

class BaseSpecialistsService extends Services
{
    const ACTION_GET_ALL_SPECIALISTS = 1;
    const ACTION_GET_FILTERED_BY_TYPE_SPECIALISTS = 2;
    const ACTION_GET_BY_ID = 3;

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
            case self::ACTION_GET_BY_ID:
                return $this->actionGetByID($config);
        }
    }


    protected function actionAllSpecialists(SpecialistsServiceConfig $config)
    {
        $portfolioModel = Portfolio::find();
        return new SpecialistsTransportModel(
            new SpecialistsConfigQuery($config, $portfolioModel),
            $portfolioModel->all()
        );
    }

    protected function actionFilteredByTypeSpecialists(SpecialistsServiceConfig $config)
    {
        $portfolioModel = Portfolio::find()->byType($config->type)->orderBy('modified_at');
        return new SpecialistsTransportModel(
            new SpecialistsConfigQuery($config, $portfolioModel),
            $portfolioModel->all()
        );
    }

    protected function actionGetByID(SpecialistsServiceConfig $config)
    {
        $portfolioModel = Portfolio::find()->where(['=', 'id', $config->id]);
        return new SpecialistsTransportModel(
            new SpecialistsConfigQuery($config, $portfolioModel),
            $portfolioModel->one()
        );
    }
}