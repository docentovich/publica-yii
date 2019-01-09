<?php

use yii\db\Schema;
use yii\db\Migration;

class m190108_145710_Relations extends Migration
{

    public function init()
    {
       $this->db = 'db';
       parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_tbl_orders_customer_id',
            '{{%orders}}','customer_id',
            '{{%usr_user}}','id',
            'RESTRICT','CASCADE'
         );
        $this->addForeignKey('fk_tbl_orders_seller_id',
            '{{%orders}}','seller_id',
            '{{%usr_user}}','id',
            'RESTRICT','CASCADE'
         );
        $this->addForeignKey('fk_tbl_orders_messages_order_id',
            '{{%orders_messages}}','order_id',
            '{{%orders}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_orders_messages_owner_id',
            '{{%orders_messages}}','owner_id',
            '{{%usr_user}}','id',
            'SET NULL','CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_tbl_orders_customer_id', '{{%orders}}');
        $this->dropForeignKey('fk_tbl_orders_seller_id', '{{%orders}}');
        $this->dropForeignKey('fk_tbl_orders_messages_order_id', '{{%orders_messages}}');
        $this->dropForeignKey('fk_tbl_orders_messages_owner_id', '{{%orders_messages}}');
    }
}
