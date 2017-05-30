<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%image}}".
 *
 * @property int $id
 * @property string $alt
 * @property string $patch
 * @property string $name
 * @property string $extension
 *
 * @property Post[] $posts
 * @property PostToImage[] $postToImages
 * @property Post[] $posts0
 * @property Profile[] $profiles
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%image}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alt'], 'string', 'max' => 70],
            [['patch'], 'string', 'max' => 150],
            [['name'], 'string', 'max' => 40],
            [['extension'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('post', 'ID'),
            'alt' => Yii::t('post', 'Alt'),
            'patch' => Yii::t('post', 'Patch'),
            'name' => Yii::t('post', 'Name'),
            'extension' => Yii::t('post', 'Extension'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostToImages()
    {
        return $this->hasMany(PostToImage::className(), ['image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts0()
    {
        return $this->hasMany(Post::className(), ['id' => 'post_id'])->viaTable('{{%post_to_image}}', ['image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::className(), ['avatar' => 'id']);
    }
}
