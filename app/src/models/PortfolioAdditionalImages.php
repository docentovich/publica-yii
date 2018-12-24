<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%probank_portfolio_additional_images}}".
 *
 * @property int $image_id
 * @property int $portfolio_id
 * @property string $type
 *
 * @property Image $image
 * @property Portfolio $portfolio
 */
class PortfolioAdditionalImages extends \yii\db\ActiveRecord
{
    const TYPE_PORTFOLIO = 'PORTFOLIO';
    const TYPE_SNAP = 'SNAP';
    const ALLOWED_TYPES = ['PORTFOLIO', 'SNAP'];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%probank_portfolio_additional_images}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image_id', 'portfolio_id'], 'required'],
            [['image_id', 'portfolio_id'], 'integer'],
            [['type'], 'string'],
            ['type', 'each', 'rule' => ['in', 'range' => [self::ALLOWED_TYPES]]],
            [['image_id', 'portfolio_id'], 'unique', 'targetAttribute' => ['image_id', 'portfolio_id']],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::class, 'targetAttribute' => ['image_id' => 'id']],
            [['portfolio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Portfolio::class, 'targetAttribute' => ['portfolio_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'image_id' => 'Image ID',
            'portfolio_id' => 'Portfolio ID',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::class, ['id' => 'image_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortfolio()
    {
        return $this->hasOne(Portfolio::class, ['id' => 'portfolio_id']);
    }
}
