<?php

namespace app\services;


use app\abstractions\Services;
use app\dto\ConfigQuery;
use app\dto\TransportModel;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

class BaseSearchService extends Services
{

    /**
     * @param \app\interfaces\config $config
     * @return \app\dto\TransportModel
     * @throws \yii\base\ExitException
     */
    public function action(\app\interfaces\config $config): \app\dto\TransportModel
    {

    }

    public function search(ConfigQuery $configQuery,  $urlOfElement)
    {
        $keyword = $configQuery->config->keyword;

        if (!\Yii::$app->request->isAjax) {
            throw new \Exception('request mast be ajax');
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if(strlen($keyword) < 4)
        {
            new \app\dto\PostTransportModel($configQuery, []);
        }

        /** @var UrlManager $url_manager */
        $url_manager = \Yii::$app->urlManagerFrontEnd;

        $result = [
            'action' => 'search',
            'result' => array_map(function($element) use ($url_manager, $urlOfElement) {
                return ArrayHelper::merge(
                    $element->toArray(),
                    [
                        "url" => $url_manager->createAbsoluteUrl([
                            $urlOfElement, "id" => $element->id
                        ])
                    ]
                );
            }, $configQuery->query->all())
        ];

        return ["configQuery" => $configQuery, "result" => $result];
    }
}