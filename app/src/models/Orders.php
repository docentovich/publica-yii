<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tbl_orders".
 *
 * @property int $id
 * @property int $customer_id
 * @property int $seller_id
 * @property int $rate
 * @property string $status
 *
 * @property User $customer
 * @property User $seller
 */
class Orders extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_INACTIVE = 'INACTIVE';

    public $myId;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'seller_id', 'rate'], 'integer'],
            [['status'], 'string'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['customer_id' => 'id']],
            [['seller_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['seller_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/user', 'ID'),
            'customer_id' => Yii::t('app/user', 'Customer ID'),
            'seller_id' => Yii::t('app/user', 'Seller ID'),
            'rate' => Yii::t('app/user', 'Rate'),
            'status' => Yii::t('app/user', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(User::class, ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeller()
    {
        return $this->hasOne(User::class, ['id' => 'seller_id']);
    }

    public function allOrders(): ActiveQuery
    {
        return self::find()
            ->andWhere([
                'customer_id' => $this->myId ?? \Yii::$app->user->getId(),
                'status' => self::STATUS_ACTIVE
            ])
            ->with('seller');
    }

    public function allSales(): ActiveQuery
    {
        return self::find()
            ->andWhere([
                'seller_id' => $this->myId ?? \Yii::$app->user->getId(),
                'status' => self::STATUS_ACTIVE
            ])
            ->with('seller');
    }
}
