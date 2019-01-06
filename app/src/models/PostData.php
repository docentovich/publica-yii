<?php

namespace app\models;


/**
 * This is the model class for table "{{%postData}}".
 *
 * @property int $post_id fkey
 * @property string $title
 * @property string $sub_header Подзаголовок
 * @property string $post_short_desc
 * @property string $post_desc
 * @property int $post_like_count
 * @property int $postLikeCount
 * @property int $postViewCount
 * @property int $post_view_count
 *
 * @property Post $post
 */
class PostData extends \yii\db\ActiveRecord
{

}
