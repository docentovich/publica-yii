<?php

namespace modules\tosee\models\common;

use Yii;
use common\models\Image;
use common\models\User;

/**
 * This is the model class for table "{{%post}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $event_at Дата события. Для поиска timestump. Триггер для приведения к нужному виду. Индекс
 * @property int $post_category_id Родительская категория. не fkey
 * @property int $image_id Главное изображение. Ссылка на ресурс.
 * @property int $status 0 - на модерации 1 - одобрено 2 - отклонено 3 - заблокировано 4 - удален
 * @property string $created_at Дата создания. Для вывода на страницу постов. Задается триггером
 *
 * @property Image $image
 * @property User $user
 * @property PostData[] $postDatas
 * @property PostToImage[] $postToImages
 * @property Image[] $images
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'post_category_id', 'image_id', 'status'], 'integer'],
            [['event_at', 'created_at'], 'safe'],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('post', 'ID'),
            'user_id' => Yii::t('post', 'User ID'),
            'event_at' => Yii::t('post', 'Event At'),
            'post_category_id' => Yii::t('post', 'Post Category ID'),
            'image_id' => Yii::t('post', 'Image ID'),
            'status' => Yii::t('post', 'Status'),
            'created_at' => Yii::t('post', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostDatas()
    {
        return $this->hasMany(PostData::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostToImages()
    {
        return $this->hasMany(PostToImage::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['id' => 'image_id'])->viaTable('{{%post_to_image}}', ['post_id' => 'id']);
    }
}
