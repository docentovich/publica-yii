<?php

namespace app\services;

use app\dto\ConfigQuery;
use app\models\User;
use app\dto\ImagesConfigQuery;
use app\dto\ImagesServiceConfig;
use app\dto\ImagesTransportModel;
use app\modules\tosee\models\ToseeLike;

/**
 * Class BaseImagesService
 * @package app\modules\tosee\services
 */
class BaseImagesService extends \app\abstractions\Services
{
    const ACTION_LIKE = 1;
    const ACTION_COMMENT = 2;

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
            case self::ACTION_COMMENT:
                return $this->actionComment($config);
        }
    }

    /**
     * @param ImagesServiceConfig $config
     * @return ImagesTransportModel
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionLike(ImagesServiceConfig $config): ImagesTransportModel
    {
        /** @var TODO refactor */
        $response = [];
        $like = ToseeLike::findOne(['image_id' => $config->id, 'user_id' => $config->user_id]);
        if (!$like) {
            $like = new ToseeLike();
            $like->load(['image_id' => $config->id, 'user_id' => $config->user_id], '');
            $like->save();
            $response = ['action' => 'like'];
        } else {
            $like->delete();
            $response = ['action' => 'unLike'];
        }

        return new ImagesTransportModel(new ConfigQuery($config), $response);
    }

    /**
     * @param ImagesServiceConfig $config
     * @return ImagesTransportModel
     * @throws \Exception
     */
    public function actionComment(ImagesServiceConfig $config): ImagesTransportModel
    {
        if(!(\Yii::$app->user->identity instanceof User)){
            throw new \Exception('user->identity mast instance ' . User::class);
        }
        $comment = $config->comment;
        $comment->save();
        $comment->link('author', \Yii::$app->user->identity);

        $response = [
            'action' => 'saved',
            'comment' => $comment->toArray()
        ];
        return new ImagesTransportModel(new ConfigQuery($config), $response);
    }

    /**
     * @param ImagesConfigQuery $configQuery
     * @return ImagesConfigQuery
     */
    public function prepareQuery(ImagesConfigQuery $configQuery): ImagesConfigQuery
    {
        return $configQuery;
    }

}