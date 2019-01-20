<?php

namespace app\models;

use yii\web\Cookie;

/**
 * This is the ActiveQuery class for [[Portfolio]].
 *
 * @see Portfolio
 */
class PortfolioQuery extends \yii\db\ActiveQuery
{
    /*    public function active()
        {
            return $this->andWhere('[[status]]=1');
        }*/

    /**
     * {@inheritdoc}
     * @return Portfolio[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Portfolio|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function type($type)
    {
        return $this->andWhere(['=', 'type', $type]);
    }

    public function city(int $city)
    {
        return $this
            ->innerJoinWith(['user user'])
            ->andWhere(['=', 'user.city_id', $city]);
    }

    public function freeDateTime(\DateTime $date, $time)
    {
        return $this
            ->alias('portfolio')
            ->join('LEFT OUTER JOIN',
                [DateTimePlanner::tableName(). ' dateTimePlanner'],
                'portfolio.user_id = dateTimePlanner.user_id'
            )->andWhere([
                'or',
                ['is', 'dateTimePlanner.date', new \yii\db\Expression('null')],
                ['<>', 'dateTimePlanner.date', $date->format('Y-m-d')],
                [
                    'and',
                    ['=', 'dateTimePlanner.date', $date->format('Y-m-d')],
                    ['<>', 'dateTimePlanner.time', $time],
                ]
            ]);
    }

    public function keyword($keyword)
    {
        $condition = [
            "or",
            ["like", "profile.name", $keyword],
            ["like", "profile.sename", $keyword],
            ["like", "profile.lastname", $keyword],
            ["like", "profile.firstname", $keyword]
        ];

        return $this->innerJoinWith(['profile profile'])
            ->andWhere($condition);
    }

    public function currentCity()
    {
        $city_id = City::DEFAULT_CITY_ID;
        if (\Yii::$app->request->cookies->has("city_id")) {
            $city_id = \Yii::$app->request->cookies->getValue("city_id");
        } else {
            \Yii::$app->response->cookies->add(new Cookie([
                'name' => 'city_id',
                'value' => $city_id
            ]));
        }

        return $this
            ->joinWith(['user user'])
            ->andWhere(["=", "user.city_id", $city_id]);
    }
}