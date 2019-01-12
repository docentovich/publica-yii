<?php

namespace app\models;

use orders\models\OrdersDateTimePlanner;
use probank\models\ProbankPortfolio;
use src\models\OrdersMessages;
use src\models\OrdersQuery;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_orders".
 *
 * @property int $id
 * @property int $customer_id from tbl_usr_user
 * @property int $portfolio_id from Probank
 * @property int $rate
 * @property string $status
 * @property string $final_message
 * @property string $finalMessage
 * @property User $customer
 * @property User $seller
 * @property Portfolio|null $portfolio
 * @property Portfolio $portfolioNN
 * @property OrdersMessages[]|null $orderMessages
 * @property OrdersMessages[] $orderMessagesNN
 * @property OrdersDateTimePlanner[]|null $dateTimePlanner
 * @property OrdersDateTimePlanner[] $dateTimePlannerNN
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
            [['customer_id', 'portfolio_id', 'rate'], 'integer'],
            [['customer_id', 'portfolio_id'], 'required'],
            [['status', 'final_message'], 'string'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['customer_id' => 'id']],
            [['portfolio_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['portfolio_id' => 'id']],
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
            'portfolio_id' => Yii::t('app/user', 'Portfolio ID'),
            'rate' => Yii::t('app/user', 'Rate'),
            'status' => Yii::t('app/user', 'Status'),
        ];
    }

    public function scenarios()
    {
        return ArrayHelper::merge(
            parent::scenarios(),
            [
                self::SCENARIO_CREATE => ['customer_id', 'portfolio_id']
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

    public function getPortfolio()
    {
        return $this->hasOne(ProbankPortfolio::class, ['id' => 'portfolio_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeller()
    {
        return $this->hasOne(User::class, ['id' => 'user_id'])
            ->via('portfolio');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderMessages()
    {
        return $this->hasMany(OrdersMessages::class, ['order_id' => 'id'])->inverseOf('order');
    }

    /**
     * @return OrdersMessages
     */
    public function getOrderMessagesNN()
    {
        return $this->orderMessages ?? new OrdersMessages();
    }

    /**
     * @return Portfolio
     */
    public function getPortfoliosNN()
    {
        return $this->portfolio ?? new Portfolio();
    }

    /**
     * @return OrdersDateTimePlanner
     */
    public function getDateTimePlannerNN()
    {
        return $this->dateTimePlanner ?? new OrdersDateTimePlanner();
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
        return (new OrdersQuery(get_called_class()))
            ->with('orderMessages')
            ->with('seller')
            ->with('dateTimePlanner');
    }

    /**
     * @return string
     */
    public function getFinalMessage()
    {
        return $this->final_message;
    }

    /**
     * @return ActiveQuery
     */
    public function getDateTimePlanner()
    {
        return $this->hasMany(OrdersDateTimePlanner::class, ['order_id' => 'id']);
    }

    /**
     * @param $message
     */
    public function setFinalMessage($message)
    {
        $this->final_message = $message;
    }
}
