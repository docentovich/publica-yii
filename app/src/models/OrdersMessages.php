<?php

namespace src\models;

use app\models\Orders;
use Yii;

/**
 * This is the model class for table "{{%orders_messages}}".
 *
 * @property int $id
 * @property int $order_id
 * @property string $message
 * @property string $created_at
 *
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
            [['order_id'], 'required'],
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
        return $this->hasOne(Orders::class, ['id' => 'order_id']);
    }

    /**
     * {@inheritdoc}
     * @return OrdersMessagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrdersMessagesQuery(get_called_class());
    }
}
