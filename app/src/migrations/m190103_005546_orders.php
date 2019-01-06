<?php

namespace src\migrations;



class m190103_005546_orders extends \src\migrations\Migration
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
            '{{%orders}}',
            [
                'id'=> $this->primaryKey(10),
                'customer_id'=> $this->integer(10)->null()->defaultValue(null),
                'seller_id'=> $this->integer(10)->null()->defaultValue(null),
                'rate'=>  'tinyint DEFAULT NULL',
                'status'=> "enum('INACTIVE', 'ACTIVE') NOT NULL DEFAULT 'ACTIVE'",
            ],$tableOptions
        );
        $this->createIndex('customer_id','{{%orders}}',['customer_id'],false);
        $this->createIndex('seller_id','{{%orders}}',['seller_id'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('customer_id', '{{%orders}}');
        $this->dropIndex('seller_id', '{{%orders}}');
        $this->dropTable('{{%orders}}');
    }
}
