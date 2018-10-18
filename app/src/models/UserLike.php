<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%userLike}}".
 *
 * @property int $user_id
 * @property string $model Ссылка на модель
 * @property int $item_id
 *
 * @property User $user
 */
class UserLike extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%usr_user_like}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'model', 'item_id'], 'required'],
            [['user_id', 'item_id'], 'integer'],
            [['model'], 'string', 'max' => 10],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'model' => 'Model',
            'item_id' => 'Item ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
