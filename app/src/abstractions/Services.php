<?php
namespace app\abstractions;

use app\dto\ConfigQuery;
use yii\db\ActiveRecord;

abstract class Services extends \yii\base\Component
{
    /**
     * @param \app\interfaces\config $config
     * @return \app\dto\TransportModel
     * @throws \yii\base\ExitException
     */
    abstract public function action(\app\interfaces\config $config): \app\dto\TransportModel;

    /**
     * `Helper`
     *
     * @param ConfigQuery $configQuery
     * @return ActiveRecord[]
     * @throws \Throwable
     */
    protected function all(ConfigQuery $configQuery)
    {
//        return \Yii::$app->db->cache(function () use ($configQuery) {
            return $configQuery->query->all();
//        });
    }

    /**
     * `Helper`
     *
     * @param ConfigQuery $configQuery
     * @return ActiveRecord[]
     * @throws \Throwable
     */
    protected function count(ConfigQuery $configQuery)
    {
//        return \Yii::$app->db->cache(function () use ($configQuery) {
            return $configQuery->query->count();
//        });
    }
    /**
     * `Helper`
     *
     * @param ConfigQuery $configQuery
     * @return ActiveRecord
     * @throws \Throwable
     */
    protected function one(ConfigQuery $configQuery)
    {
//        return \Yii::$app->db->cache(function () use ($configQuery) {
            return $configQuery->query->one();
//        });
    }
}