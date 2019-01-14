<?php

namespace src\models;

use app\models\Orders;

/**
 * This is the ActiveQuery class for [[Orders]].
 *
 * @see Orders
 */
class OrdersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Orders[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Orders|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function portfolioId($seller_id)
    {
        return $this->andWhere(['=', 'portfolio_id', $seller_id]);
    }

    public function customerId($consumer_id)
    {
        return $this->andWhere(['=', 'customer_id', $consumer_id]);
    }

    public function orderId($order_id)
    {
        return $this->andWhere(['=', 'id', $order_id]);
    }

    public function active(){
        return $this->andWhere(['=', 'status', Orders::STATUS_ACTIVE]);
    }

    public function finished(){
        return $this->andWhere(['=', 'status', Orders::STATUS_FINISHED]);
    }

    public function sales($id)
    {
        return $this->andWhere([
            'seller_id' => $id,
            'status' => Orders::STATUS_ACTIVE
        ])->with('customers');
    }

    public function purchases($id)
    {
        return $this->andWhere([
            'customer_id' => $id,
            'status' => Orders::STATUS_ACTIVE
        ])->with('customers');
    }
}
