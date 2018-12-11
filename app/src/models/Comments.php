<?php

namespace app\models;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%comments}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $image_id
 * @property string $title
 * @property string $text
 * @property User|null $user
 * @property User $userNN
 *
 * @property Image $avatar0
 */
class Comments extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;

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
            [['image_id', 'user_id'], 'integer'],
            [['text'], 'required'],
            [['text', 'title'], 'string'],
            [['image_id'], 'exist',  'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User',
            'image_id' => 'Image',
            'title' => 'Title',
            'text' => 'Text',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id'])->with(['profile']);
    }

    public function getUserNN()
    {
        return $this->user ?? new User();
    }

    public function toArray(array $fields = [], array $expand = [], $recursive = true)
    {
        return ArrayHelper::merge(
            parent::toArray(),
            [
                "user" => $this->userNN->toArray()
            ]
        );
    }
}
