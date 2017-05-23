<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%userAbout}}".
 *
 * @property int $user_id
 * @property string $about
 *
 * @property User $user
 */
class UserAbout extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_about}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['about'], 'required'],
            [['about'], 'string'],
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
            'about' => 'About',
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
