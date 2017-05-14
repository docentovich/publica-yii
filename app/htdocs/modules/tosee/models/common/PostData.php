<?php

namespace modules\tosee\models\common;

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
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%postData}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
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
            'title' => 'Title',
            'sub_header' => 'Sub Header',
            'post_short_desc' => 'Post Short Desc',
            'post_desc' => 'Post Desc',
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
