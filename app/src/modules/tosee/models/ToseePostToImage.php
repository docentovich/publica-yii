<?php

namespace tosee\models;

use app\models\PostToImage;

class ToseePostToImage extends PostToImage
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tosee_post_to_image}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'image_id'], 'required'],
            [['post_id', 'image_id'], 'integer'],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => ToseeImage::className(), 'targetAttribute' => ['image_id' => 'id']],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => ToseePost::className(), 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_id' => 'Post ID',
            'image_id' => 'Image ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(ToseeImage::class, ['id' => 'image_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(ToseePost::class, ['id' => 'post_id']);
    }
}