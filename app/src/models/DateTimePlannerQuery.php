<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[DateTimePlanner]].
 *
 * @see OrdersDateTimePlanner
 */
class DateTimePlannerQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    public function user($user_id)
    {
        return $this->andWhere(['=', 'user_id', $user_id]);
    }

    public function date($date)
    {
        return $this->andWhere(['=', 'date', $date]);
    }
    /**
     * {@inheritdoc}
     * @return DateTimePlanner[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return DateTimePlanner|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
