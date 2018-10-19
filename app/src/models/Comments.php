<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%comments}}".
 *
 * @property int $id
 * @property int $avatar
 * @property string $title
 * @property string $text
 *
 * @property Image $avatar0
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comments}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['avatar'], 'integer'],
            [['title', 'text'], 'required'],
            [['text'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['avatar'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['avatar' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'avatar' => 'Avatar',
            'title' => 'Title',
            'text' => 'Text',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvatar0()
    {
        return $this->hasOne(Image::className(), ['id' => 'avatar']);
    }
}
