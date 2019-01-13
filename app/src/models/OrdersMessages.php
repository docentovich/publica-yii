<?php

namespace src\models;

use app\models\Orders;
use app\models\User;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%orders_messages}}".
 *
 * @property int $id
 * @property int $order_id
 * @property string $message
 * @property string $created_at
 * @property int $owner_id
 * @property User $owner
 * @property Orders $order
 */
class OrdersMessages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%orders_messages}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'message'], 'required'],
            [['order_id'], 'integer'],
            [['message'], 'string'],
            [['created_at'], 'safe'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/probank', 'ID'),
            'order_id' => Yii::t('app/probank', 'Order ID'),
            'message' => Yii::t('app/probank', 'Message'),
            'created_at' => Yii::t('app/probank', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::class, ['id' => 'order_id'])->inverseOf('orderMessages');
    }

    public function getOwner()
    {
        return $this->hasOne(User::class, ['id' => 'owner_id']);
    }

    /**
     * {@inheritdoc}
     * @return OrdersMessagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrdersMessagesQuery(get_called_class());
    }

    public function toArray(array $fields = [], array $expand = [], $recursive = true)
    {
        return ArrayHelper::merge(
            parent::toArray($fields, $expand, $recursive),
            ['owner' => $this->owner]
        );
    }
}
