<?php

namespace app\modules\tosee\models;

use app\abstractions\UpperCaseToUnderscoreGetter;
use Yii;

/**
 * This is the model class for table "{{%postData}}".
 *
 * @property int $post_id fkey
 * @property string $title
 * @property string $sub_header Подзаголовок
 * @property string $post_short_desc
 * @property string $post_desc
 * @property int $post_like_count
 * @property int $post_view_count
 *
 * @property Post $post
 */
class PostData extends \yii\db\ActiveRecord
{
    use UpperCaseToUnderscoreGetter;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tosee_post_data}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id'], 'required'],
            [['title', 'sub_header'], 'required'],
            [['sub_header', 'post_desc'], 'string'],
            [['post_like_count', 'post_view_count'], 'integer'],
            [['title', 'post_short_desc'], 'string', 'max' => 255],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_id' => 'Post ID',
            'title' => 'Заголовок',
            'sub_header' => 'Подзаголовок',
            'post_short_desc' => 'Короткое поисание',
            'post_desc' => 'Описание поста',
            'post_like_count' => 'Post Like Count',
            'post_view_count' => 'Post View Count',

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }
}
