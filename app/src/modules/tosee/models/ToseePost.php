<?php

namespace tosee\models;

use app\models\Post;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class ToseePost extends Post
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
            [['event_at', 'city_id', 'user_id'], 'required'],
            [['post_category_id', 'image_id', 'status'], 'integer'],
            [['event_at', 'created_at', 'user_id', 'city_id'], 'safe'],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => ToseeImage::class, 'targetAttribute' => ['image_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => ToseeUser::class, 'targetAttribute' => ['user_id' => 'id']],
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
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(ToseeImage::className(), ['id' => 'image_id']);
    }

    /**
     * @return ToseeImage
     */
    public function getImageNN()
    {
        $image = $this->image ?? new ToseeImage();
        $image->setRelativeUploadPathLabel($this->getAttributeLabel('relativeUploadPath'));
        return $image;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(ToseeUser::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostData()
    {
        return $this->hasOne(ToseePostData::class, ['post_id' => 'id']);
    }

    /**
     * @return PostData|null
     */
    public function getPostDataNN()
    {
        return $this->_postData ?? ($this->_postData = ($this->postData ?? new ToseePostData()));
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostToImages()
    {
        return $this->hasMany(ToseePostToImage::class, ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdditionalImages()
    {
        return $this->hasMany(ToseeImage::class, ['id' => 'image_id'])
            ->viaTable(ToseePostToImage::tableName(), ['post_id' => 'id'])
            ->with(['comments']);
    }

    public function getAdditionalImagesNN()
    {
        $additionalImages = $this->additionalImages;
        return (!empty($additionalImages)) ? $additionalImages : new ToseeImage();
    }

    /**
     * @param array $fields
     * @param array $expand
     * @param bool $recursive
     * @return array
     */
    public function toArray(array $fields = [], array $expand = [], $recursive = true)
    {
        return ArrayHelper::merge(
            parent::toArray(),
            ["search_text" => $this->postDataNN->title],
            ["post_data" => $this->postDataNN->toArray()],
            ["front_url" => ($this->id) ? Url::to(['front/post', "id" => $this->id], true) : null]
        );
    }

    /**
     * {@inheritdoc}
     * @return PostQuery|\yii\db\ActiveQuery
     */
    public static function find()
    {
        return new ToseePostQuery(get_called_class());
    }

    public function getEventAt()
    {
        return $this->event_at;
    }

    public function beforeValidate()
    {
        $this->user_id = $this->user_id ?? \Yii::$app->user->getId();
        return parent::beforeValidate();
    }
}