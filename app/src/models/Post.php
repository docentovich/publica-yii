<?php

namespace app\models;

use app\beheviors\PostBeforeValidate;
use Yii;
use app\models\Image;
use app\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%post}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $event_at Дата события. Для поиска timestump. Триггер для приведения к нужному виду. Индекс
 * @property int $post_category_id Родительская категория. не fkey
 * @property int $image_id Главное изображение. Ссылка на ресурс.
 * @property int $city_id
 * @property int $status 0 - на модерации 1 - одобрено 2 - отклонено 3 - заблокировано 4 - удален
 * @property string $created_at Дата создания. Для вывода на страницу постов. Задается триггером
 * @property Post nextPost
 * @property Post prevPost
 * @property Image|null $image
 * @property Image $imageNN
 * @property User $user
 * @property PostData|null $postData
 * @property PostData $postDataNN
 * @property Image|null $additionalImages
 * @property Image $additionalImagesNN
 * @property PostToImage[]|null $postToImages
 */
class Post extends yii\db\ActiveRecord
{
    CONST STATUS_ON_MODERATE = 0;
    CONST STATUS_NOT_PASS_MODERATE = 1;
    CONST STATUS_BLOCKED = 2;
    CONST STATUS_ACTIVE = 3;
    CONST STATUS_DELETED = 4;
    private $cache = [];
    private $_postData;

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
            [['event_at', 'city_id'], 'required'],
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
            'city_id' => Yii::t('app/user', 'Город'),
            'post_category_id' => Yii::t('app/tosee', 'Post Category ID'),
            'image_id' => Yii::t('app/tosee', 'Image ID'),
            'status' => Yii::t('app/tosee', 'Статус'),
            'created_at' => Yii::t('app/tosee', 'Создан'),
            'postDataTitle' => Yii::t('app/tosee', 'Заголовок поста'),
            'relativeUploadPath' => Yii::t('app/tosee', 'Заголовное фото'),
            'image' => Yii::t('app/tosee', 'Заголовное фото')
        ];
    }

    /**
     * @inheritdoc
     */
//    public function behaviors()
//    {
//        return [
//            'class' => PostBeforeValidate::className(),
//        ];
//    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_id']);
    }


    /**
     * @return Image
     */
    public function getImageNN()
    {
        $image = $this->image ?? new Image();
        $image->setRelativeUploadPathLabel($this->getAttributeLabel('relativeUploadPath'));
        return $image;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostData()
    {
        return $this->hasOne(PostData::class, ['post_id' => 'id']);
    }

    public function getPostDataNN()
    {
        return $this->_postData ?? ($this->_postData = ($this->postData ?? new PostData()));
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostToImages()
    {
        return $this->hasMany(PostToImage::class, ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdditionalImages()
    {
        return $this->hasMany(Image::class, ['id' => 'image_id'])
            ->viaTable(PostToImage::tableName(), ['post_id' => 'id'])
            ->with(['comments']);
    }

    public function getAdditionalImagesNN()
    {
        $additionalImages = $this->additionalImages;
        return (!empty($additionalImages)) ? $additionalImages : new Image();
    }

    public function toArray(array $fields = [], array $expand = [], $recursive = true)
    {
        return ArrayHelper::merge(
            parent::toArray(),
            ["post_data" => $this->postDataNN->toArray()],
            ["front_url" => ($this->id) ? Url::to(['front/post', "id" => $this->id], true) : null]
        );
    }
}
