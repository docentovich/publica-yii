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
 * @property PortfolioAdditionalImages[] $probankPortfolioAdditionalImages@modules
 * @property Image[] $images
 */
class Portfolio extends \yii\db\ActiveRecord
{
    const SCENARIO_UPDATE = 'update';

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
            [['main_photo', 'user_id'], 'integer'],
            [['main_photo'], 'exist', 'skipOnError' => true, 'targetClass' => Image::class, 'targetAttribute' => ['main_photo' => 'id']],
            [['user_id'], 'unique'],
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

    public function getAdditionalImagesNN()
    {
        $additionalImages = $this->additionalImages;
        return (!empty($additionalImages)) ? $additionalImages : new Image();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id'])->inverseOf('portfolio');
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
}