<?php

namespace app\services;


use app\dto\ConfigQuery;
use app\models\Comments;
use app\dto\CommentsConfigQuery;
use app\dto\CommentsServiceConfig;
use app\dto\CommentsTransportModel;
use League\Pipeline\Pipeline;
use yii\db\ActiveRecord;

class BaseCommentsService extends  \app\abstractions\Services
{
    const ACTION_GET_COMMENTS_BY_IMAGE_ID = 1;
    const ACTION_SAVE_COMMENT = 2;
    const ACTION_GET_MY_COMMENTS = 3;

    /**
     * @param CommentsServiceConfig $config
     * @return CommentsTransportModel
     */
    public function action(\app\interfaces\config $config): \app\dto\TransportModel
    {
        switch ($config->action) {
            case self::ACTION_GET_COMMENTS_BY_IMAGE_ID:
                return $this->actionGetCommentsByImage($config);
            case self::ACTION_SAVE_COMMENT:
                return $this->actionSaveComment($config);
            case self::ACTION_GET_MY_COMMENTS:
                return $this->actionGetMyComments($config);
        }
    }

    private function actionGetCommentsByImage(CommentsServiceConfig $config): CommentsTransportModel
    {
        $configQuery = (new Pipeline())
            ->pipe([$this, 'prepareQuery'])
            ->pipe([$this, 'prepareQueryByImage'])
            ->process(new ConfigQuery($config, Comments::find()));

        return new CommentsTransportModel($configQuery, $this->all($configQuery));
    }

    private function actionSaveComment(CommentsServiceConfig $config): CommentsTransportModel
    {
        return new CommentsTransportModel(new ConfigQuery($config), []);
    }

    private function actionGetMyComments(CommentsServiceConfig $config): CommentsTransportModel
    {
        $configQuery = (new Pipeline())
            ->pipe([$this, 'prepareQuery'])
            ->pipe([$this, 'prepareQueryMyComments'])
            ->process(new ConfigQuery($config, Comments::find()));

        return new CommentsTransportModel($configQuery, $this->all($configQuery));
    }

    /**
     * @param CommentsConfigQuery $configQuery
     * @return CommentsConfigQuery
     */
    public function prepareQuery(CommentsConfigQuery $configQuery): CommentsConfigQuery
    {
        $configQuery->query->with(["user"])
            ->andWhere(['=', 'status', Comments::STATUS_ACTIVE]);
        return $configQuery;
    }

    /**
     * @param CommentsConfigQuery $configQuery
     * @return CommentsConfigQuery
     */
    public function prepareQueryMyComments(CommentsConfigQuery $configQuery): CommentsConfigQuery
    {
        $configQuery->query->andWhere(['=', 'user_id', \Yii::$app->user->getId()]);
        return $configQuery;
    }

    /**
     * @param CommentsConfigQuery $configQuery
     * @return CommentsConfigQuery
     */
    public function prepareQueryByImageId(CommentsConfigQuery $configQuery): CommentsConfigQuery
    {
        $configQuery->query->andWhere(['=', 'image_id', $configQuery->config->image_id]);
        return $configQuery;
    }
}