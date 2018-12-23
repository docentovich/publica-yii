<?php

namespace app\models;

use app\models\Image;
use app\models\User;
use yii\db\ActiveRecord;

/**
 * Class Like
 * @property User $user;
 * @property Image $image;
 * @property integer $image_id;
 * @property integer $user_id;
 * @package app\models
 */
class Like extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%likes}}';
    }

    public function rules()
    {
        return [
            [['image_id', 'user_id'], 'integer'],
        ];
    }

    public function getImage()
    {
        return $this->hasOne(Image::class, ['id' => 'image_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}