<?php

namespace src\models;

/**
 * This is the ActiveQuery class for [[OrdersMessages]].
 *
 * @see OrdersMessages
 */
class OrdersMessagesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OrdersMessages[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OrdersMessages|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
