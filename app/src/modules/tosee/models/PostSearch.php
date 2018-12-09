<?php

namespace app\modules\tosee\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PostSearch represents the model behind the search form of `app\modules\tosee\models\common\Post`.
 */
class PostSearch extends \app\modules\tosee\models\Post
{
    public $postDataTitle;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'post_category_id', 'image_id', 'status'], 'integer'],
            [['event_at', 'created_at', 'postDataTitle'], 'safe'],
        ];
    }

//    /**
//     * @inheritdoc
//     */
//    public function scenarios()
//    {
//        // bypass scenarios() implementation in the parent class
//        return Model::scenarios();
//    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $a = Yii::$app->request->queryParams;
        $query = PostSearch::find()->where(["=", "user_id", Yii::$app->user->identity->getId()]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['attributes' => ['created_at']]
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'event_at',
                'postDataTitle' => [
                    'asc'   => [ PostData::tableName() . '.title' => SORT_ASC ],
                    'desc'  => [ PostData::tableName() . '.title' => SORT_DESC ],
                    'label' => 'Заголовок'
                ],
                'created_at'
            ]
        ]);
        if( !$this->load($params) )
        {
            return $dataProvider;
        }
        $self = $this;
        $query->joinWith(['postData' => function ($q) use ($self) {
            $q->where( PostData::tableName() . '.title LIKE "%' . $self->postDataTitle . '%" ');
        }]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'event_at' => $this->event_at,
            'post_category_id' => $this->post_category_id,
            'image_id' => $this->image_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ]);

        return $dataProvider;
    }
}
