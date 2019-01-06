<?php

namespace app\models;

/**
 * This is the model class for table "{{%post_to_image}}".
 *
 * @property int $post_id
 * @property int $image_id
 *
 * @property Image $image
 * @property Post $post
 */
class PostToImage extends \yii\db\ActiveRecord
{

}
