<?php

namespace app\modules\tosee\services;

use app\dto\ConfigQuery;
use app\models\Image;
use app\modules\tosee\dto\ImagesConfigQuery;
use app\modules\tosee\dto\ImagesServiceConfig;
use app\modules\tosee\dto\ImagesTransportModel;
use app\modules\tosee\models\Like;
use League\Pipeline\Pipeline;

/**
 * Class ImagesService
 * @package app\modules\tosee\services
 */
class ImagesService extends \app\abstractions\Services
{
    const ACTION_LIKE = 1;
    const ACTION_GET_LIKES_BY_IMAGE_ID = 1;
    const ACTION_IS_I_HAVE_LIKED = 2;

    /**
     * @param \app\interfaces\config $config
     * @return \app\dto\TransportModel
     * @throws \Throwable
     */
    public function action(\app\interfaces\config $config): \app\dto\TransportModel
    {
        switch ($config->action) {
            case self::ACTION_LIKE:
                return $this->actionLike($config);
            case self::ACTION_GET_LIKES_BY_IMAGE_ID:
                return $this->actionGetLikesCountByImage($config);
            case self::ACTION_IS_I_HAVE_LIKED:
                return $this->isIHaveLiked($config);
        }
    }

    /**
     * @param ImagesServiceConfig $config
     * @return ImagesTransportModel
     */
    public function actionLike(ImagesServiceConfig $config): ImagesTransportModel
    {
        $response = true;
        try {
            new Like(['image_id' => $config->id, 'user_id' => $config->user_id]);
        }catch (\Exception $e){
            $response = false;
        }

        return new ImagesTransportModel(new ConfigQuery($config), $response);
    }

    /**
     * @param ImagesServiceConfig $config
     * @return ImagesTransportModel
     */
    public function isIHaveLiked(ImagesServiceConfig $config): ImagesTransportModel
    {
        $response = Like::findOne(['image_id' => $config->id, 'user_id' => $config->user_id]);
        return new ImagesTransportModel(new ConfigQuery($config), !!$response);
    }

    /**
     * @param ImagesServiceConfig $config
     * @return ImagesTransportModel
     * @throws \Throwable
     */
    public function actionGetLikesCountByImage(ImagesServiceConfig $config): ImagesTransportModel
    {
        $configQuery = (new Pipeline())
            ->pipe([$this, 'prepareQuery'])
            ->pipe([$this, 'prepareQueryByImageId'])
            ->process(new ConfigQuery($config, Like::find()));

        return new ImagesTransportModel($configQuery, $this->count($configQuery));
    }

    /**
     * @param ImagesConfigQuery $configQuery
     * @return ImagesConfigQuery
     */
    public function prepareQuery(ImagesConfigQuery $configQuery): ImagesConfigQuery
    {
        return $configQuery;
    }

    /**
     * @param ImagesConfigQuery $configQuery
     * @return ImagesConfigQuery
     */
    public function prepareQueryByImageId(ImagesConfigQuery $configQuery): ImagesConfigQuery
    {
        $configQuery->query->andWhere(['=', 'image_id', $configQuery->config->id]);
        return $configQuery;
    }
}