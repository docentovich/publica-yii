<?php

namespace app\models;

use src\models\OrdersMessages;
use src\models\OrdersQuery;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_orders".
 *
 * @property int $id
 * @property int $customer_id
 * @property int $seller_id
 * @property int $rate
 * @property string $status
 * @property string $final_message
 * @property string $finalMessage
 * @property User $customer
 * @property User $seller
 * @property OrdersMessages|null $orderMessages
 * @property OrdersMessages $orderMessagesNN
 */
class Orders extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_INACTIVE = 'INACTIVE';
    const STATUS_FINISHED = 'FINISHED';
    const SCENARIO_CREATE = 'create';
    const SCENARIO_MESSAGE = 'message';

    public $myId;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%orders}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'seller_id', 'rate'], 'integer'],
            [['customer_id', 'seller_id'], 'required'],
            [['status', 'final_message'], 'string'],
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

    public function scenarios()
    {
        return ArrayHelper::merge(
            parent::scenarios(),
            [
                self::SCENARIO_CREATE => ['customer_id', 'seller_id']
            ]
        );
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderMessages()
    {
        return $this->hasMany(OrdersMessages::class, ['order_id' => 'id']);
    }

    /**
     * @return OrdersMessages
     */
    public function getOrderMessagesNN()
    {
        return $this->orderMessages ?? new OrdersMessages();
    }

    public function allOrders(): ActiveQuery
    {
        return self::find()->purchases($this->myId ?? \Yii::$app->user->getId());
    }


    public function allSales(): ActiveQuery
    {
        return self::find()->sales($this->myId ?? \Yii::$app->user->getId());

    }

    /**
     * {@inheritdoc}
     * @return OrdersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return (new OrdersQuery(get_called_class()))->with('orderMessages');
    }

    /**
     * @return string
     */
    public function getFinalMessage()
    {
        return $this->final_message;
    }

    /**
     * @param $message
     */
    public function setFinalMessage($message)
    {
        $this->final_message = $message;
    }
}
