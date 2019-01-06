<?php

namespace DateTimePlanner\models;

/**
 * This is the ActiveQuery class for [[DateTimePlanner]].
 *
 * @see DateTimePlanner
 */
class DateTimePlannerQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

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
