<?php

namespace modules\tosee\models\common;

use Yii;
use common\models\Image;

/**
 * This is the model class for table "{{%post}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $event_at Дата события. Для поиска timestump. Триггер для приведения к нужному виду. Индекс
 * @property int $post_category_id Родительская категория. не fkey
 * @property int $image_id Главное изображение. Ссылка на ресурс.
 * @property int $status 0 - на модерации 1 - одобрено 2 - отклонено 3 - заблокировано 4 - удален
 * @property int $created_at Дата создания. Для вывода на страницу постов. Задается триггером
 *
 * @property User $user
 * @property Image $image
 * @property PostData $postData
 * @property PostImage[] $postImages
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
            [['user_id', 'created_at'], 'required'],
            [['user_id', 'event_at', 'post_category_id', 'image_id', 'status', 'created_at'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'event_at' => 'Event At',
            'post_category_id' => 'Post Category ID',
            'image_id' => 'Image ID',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
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
    public function getImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostData()
    {
        return $this->hasOne(PostData::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostImages()
    {
        return $this->hasMany(Image::className(), ['id' => 'image_id'])
            ->viaTable("{{%post_to_image}}", ['post_id' => 'id']);
    }



    public static function get_future_posts($page, $items_limit){

        return self::find()
            ->with(["postData", "image"])
            ->all();

    }

    public static function get_past_posts($page, $items_limit){

    }


    public static function get_range_posts($date, $page, $items_limit){
//        if ($date == NULL) $date = date("Y-m-d");

    }




}
