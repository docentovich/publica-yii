<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%city}}".
 *
 * @property int $id
 * @property string $name
 * @property string $label
 *
 * @property Post[] $posts
 * @property User[] $users
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%city}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 5],
            [['label'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('post', 'ID'),
            'name' => Yii::t('post', 'Name'),
            'label' => Yii::t('post', 'Label'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['city_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['city_id' => 'id']);
    }
}
