<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%probank_portfolio}}".
 *
 * @property int $id
 * @property string $about
 * @property double $price
 * @property int $main_photo
 *
 * @property Image|null $mainPhoto
 * @property Image $mainPhotoNN
 * @property User $user
 * @property DateTimePlanner $dateTimePlanner
 * @property PortfolioAdditionalImages[]|null $additionalImages
 * @property PortfolioAdditionalImages[] $additionalImagesNN
 * @property Image[] $images
 * @property integer $user_id
 * @property integer $userId
 * @property integer $image_id
 * @property string $type
 * @property string $typeEn
 * @property int $ordersCount
 * @property float $rating
 * @property Profile|null $profile
 */
class Portfolio extends \yii\db\ActiveRecord
{
    const SCENARIO_UPDATE = 'update';

    const ALLOWED_TYPES = ['MODEL', 'PHOTOGRAPHER'];
    const PORTFOLIO_MODEL_TYPE = 'MODEL';
    const PORTFOLIO_PHOTOGRAPHER_TYPE = 'PHOTOGRAPHER';


    public static function getSeparatedAllowedTypes($separator = ',')
    {
        return implode($separator, self::ALLOWED_TYPES);
    }

    public static function getTypesLabels()
    {
        return [
            self::PORTFOLIO_MODEL_TYPE => 'Model',
            self::PORTFOLIO_PHOTOGRAPHER_TYPE => 'Photographer'
        ];
    }

    public function getTypeEn()
    {
        return self::getTypesLabels()[$this->type];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%probank_portfolio}}';
    }

    public function scenarios()
    {
        return ArrayHelper::merge(
            parent::scenarios(),
            [
                self::SCENARIO_UPDATE => ['about', 'price', 'main_photo', 'user_id']
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['about'], 'string'],
            [['price'], 'number'],
            [['type'], 'string'],
            ['type', 'each', 'rule' => ['in', 'range' => [self::ALLOWED_TYPES]]],
            [['main_photo', 'user_id'], 'integer'],
            [['main_photo'], 'exist', 'skipOnError' => true, 'targetClass' => Image::class, 'targetAttribute' => ['main_photo' => 'id']],
            [['user_id'], 'unique', 'targetAttribute' => ['user_id', 'type']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/probank', 'ID'),
            'about' => Yii::t('app/probank', 'About'),
            'price' => Yii::t('app/probank', 'Price Rub'),
            'main_photo' => Yii::t('app/probank', 'Main Photo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMainPhoto()
    {
        return $this->hasOne(Image::class, ['id' => 'main_photo']);
    }

    /**
     * @return Image
     */
    public function getMainPhotoNN()
    {
        return $this->mainPhoto ?? new Image();
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdditionalImages()
    {
        return $this->hasMany(Image::class, ['id' => 'image_id'])
            ->viaTable(PortfolioAdditionalImages::tableName(), ['portfolio_id' => 'id'])
            ->with(['comments']);
    }

    /**
     * @return PortfolioAdditionalImages[]
     */
    public function getAdditionalImagesNN()
    {
        $additionalImages = $this->additionalImages;
        return (!empty($additionalImages)) ? $additionalImages : [new Image()];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id'])->inverseOf('portfolio');
    }

    public function getDateTimePlanner()
    {
        return $this->hasMany(DateTimePlanner::class, ['user_id' => 'id'])
            ->via('user');
    }

    public function getProfile()
    {
        return$this->hasOne(Profile::class, ['user_id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return PortfolioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PortfolioQuery(get_called_class());
    }

    public function beforeValidate()
    {
        $this->user_id = \Yii::$app->user->getId();
        return parent::beforeValidate();
    }

    public function toArray(array $fields = [], array $expand = [], $recursive = true)
    {
        return ArrayHelper::merge(
            parent::toArray(),
            ["search_text" => $this->profile->fullName]
        );
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getOrders()
    {
        return $this->hasMany(Orders::class, ['portfolio_id' => 'id']);
    }

    public function getOrdersCount()
    {
        return $this->getOrders()->count();
    }

    public function getRating()
    {
        return number_format($this->getOrders()->average('rate'),1);
    }
}