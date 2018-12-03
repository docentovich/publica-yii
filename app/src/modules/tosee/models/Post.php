<?php

namespace app\modules\tosee\models;

use app\abstractions\UpperCaseToUnderscoreGetter;
use app\beheviors\PostBeforeValidate;
use app\models\Comments;
use Yii;
use app\models\Image;
use app\models\User;

/**
 * This is the model class for table "{{%post}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $event_at Дата события. Для поиска timestump. Триггер для приведения к нужному виду. Индекс
 * @property string $eventAt
 * @property int $post_category_id Родительская категория. не fkey
 * @property int $image_id Главное изображение. Ссылка на ресурс.
 * @property int $status 0 - на модерации 1 - одобрено 2 - отклонено 3 - заблокировано 4 - удален
 * @property string $created_at Дата создания. Для вывода на страницу постов. Задается триггером
 * @property Post nextPost
 * @property Post prevPost
 * @property Image $image
 * @property User $user
 * @property PostData $postData
 * @property PostToImage[] $postToImages
 * @property Image[] $images
 */
class Post extends yii\db\ActiveRecord
{
    use UpperCaseToUnderscoreGetter;
    CONST STATUS_ON_MODERATE = 0;
    CONST STATUS_NOT_PASS_MODERATE = 1;
    CONST STATUS_BLOCKED = 2;
    CONST STATUS_ACTIVE = 3;
    private $cache = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tosee_post}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_category_id', 'image_id', 'status'], 'integer'],
            [['event_at', 'created_at', 'user_id', 'city_id'], 'safe'],
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
            'id' => Yii::t('app/tosee', 'ID'),
            'user_id' => Yii::t('app/tosee', 'User ID'),
            'event_at' => Yii::t('app/tosee', 'Дата события'),
            'city' => Yii::t('app/user', 'Город'),
            'post_category_id' => Yii::t('app/tosee', 'Post Category ID'),
            'image_id' => Yii::t('app/tosee', 'Image ID'),
            'status' => Yii::t('app/tosee', 'Статус'),
            'created_at' => Yii::t('app/tosee', 'Создан'),
            'postDataTitle' => Yii::t('app/tosee', 'Заголовок поста'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'class' => PostBeforeValidate::className(),
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
    public function getPostData()
    {
        return $this->hasOne(PostData::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostToImages()
    {
        return $this->hasMany(PostToImage::className(), ['post_id' => 'id']);
    }

    public function getPostDataTitle()
    {
        return $this->postData->title;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['id' => 'image_id'])
            ->viaTable(PostToImage::tableName(), ['post_id' => 'id'])
            ->with(['comments']);
    }

    public function getPostDataShortDesc()
    {
        return $this->postData->post_short_desc;
    }

    public function getPostDataDesc()
    {
        return $this->postData->post_desc;
    }

}
