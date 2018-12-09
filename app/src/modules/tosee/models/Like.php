<?php

namespace app\modules\tosee\models;

use app\models\Image;
use app\models\User;
use yii\db\ActiveRecord;

/**
 * Class Like
 * @property User $user;
 * @property Image $image;
 * @property integer $image_id;
 * @property integer $user_id;
 * @package app\modules\tosee\models
 */
class Like extends ActiveRecord
{
    /** @var integer */
    public $image_id;
    /** @var integer */
    public $user_id;

    public function getImage()
    {
        return $this->hasOne(Image::class, ['id' => 'image_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}