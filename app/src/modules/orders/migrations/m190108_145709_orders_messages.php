<?php

use yii\db\Schema;
use yii\db\Migration;

class m190108_145709_orders_messages extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable(
            '{{%orders_messages}}',
            [
                'id'=> $this->primaryKey(10),
                'order_id'=> $this->integer(10)->notNull(),
                'message'=> $this->text()->null()->defaultValue(null),
                'created_at'=> $this->timestamp()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
                'owner_id'=> $this->integer(10)->null()->defaultValue(null),
            ],$tableOptions
        );
        $this->createIndex('order_id','{{%orders_messages}}',['order_id'],false);
        $this->createIndex('owner_id','{{%orders_messages}}',['owner_id'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('order_id', '{{%orders_messages}}');
        $this->dropIndex('owner_id', '{{%orders_messages}}');
        $this->dropTable('{{%orders_messages}}');
    }
}
