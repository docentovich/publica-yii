<?php

namespace tosee\models;

use app\models\PostQuery;
use yii\web\Cookie;

class ToseePostQuery extends PostQuery
{
    public function orderByDate($sort)
    {
        return $this->orderBy([
            'event_at' =>  $sort,
            'id' => $sort,
        ]);
    }

    public function orderByDateAsc()
    {
        return $this->orderBy([
            'event_at' =>  SORT_ASC,
            'id' => SORT_ASC,
        ]);
    }

    public function orderByDateDesc()
    {
        return $this->orderBy([
            'event_at' =>  SORT_DESC,
            'id' => SORT_DESC,
        ]);
    }

    public function active()
    {
        return $this->andWhere(['=', 'status', ToseePost::STATUS_ACTIVE]);
    }

    public function currentCity()
    {
        $city_id = ToseeCity::DEFAULT_CITY_ID;
        if (\Yii::$app->request->cookies->has("city_id")) {
            $city_id = \Yii::$app->request->cookies->getValue("city_id");
        } else {
            \Yii::$app->response->cookies->add(new Cookie([
                'name' => 'city_id',
                'value' => $city_id
            ]));
        }

        return $this->andWhere(["=", "city_id", $city_id]);
    }


    public function future()
    {
        return $this->andWhere(['>', "event_at", date('Y-m-d')]);
    }

    public function past()
    {
        return $this->andWhere(['<', "event_at", date('Y-m-d')]);
    }


    public function date(\DateTime $date)
    {
        return $this->andWhere(['=', "event_at", $date->format('Y-m-d')]);
    }

    public function keyword($keyword)
    {
        $keyword = strtolower($keyword);
        $condition = [
            "or",
            ["like", "lower(postData.title)", $keyword],
            ["like", "lower(postData.sub_header)", $keyword],
            ["like", "lower(postData.post_short_desc)", $keyword],
            ["like", "lower(postData.post_desc)", $keyword]
        ];

        return $this->joinWith(['postData postData'])
            ->andOnCondition($condition);
    }

    public function id($id)
    {
        return $this->andWhere(['id' => $id]);
    }


    /**
     * {@inheritdoc}
     * @return ToseePost[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ToseePost|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}