<?php

namespace orders\migrations;

use yii\db\Schema;
use yii\db\Migration;

class m190108_145708_orders extends Migration
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
                'portfolio_id'=> $this->integer(10)->null()->defaultValue(null),
                'rate'=> 'tinyint(3) DEFAULT null',
                'status'=> "enum('INACTIVE', 'ACTIVE', 'FINISHED') NOT NULL DEFAULT 'ACTIVE'",
                'final_message'=> $this->text()->null()->defaultValue(null),
            ],$tableOptions
        );
        $this->createIndex('customer_id','{{%orders}}',['customer_id'],false);
        $this->createIndex('portfolio_id','{{%orders}}',['portfolio_id'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('customer_id', '{{%orders}}');
        $this->dropIndex('portfolio_id', '{{%orders}}');
        $this->dropTable('{{%orders}}');
    }
}
