<?php

use yii\db\Schema;
use app\migrations\Migration;

class m181019_142956_auth_assignment extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        // $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%auth_assignment}}',
            [
                'item_name'=> $this->string(64)->notNull(),
                'user_id'=> $this->string(64)->notNull(),
                'created_at'=> $this->integer(11)->null()->defaultValue(null),
            ],$this->tableOptions
        );
        $this->addPrimaryKey('pk_on_tbl_auth_assignment','{{%auth_assignment}}',['item_name','user_id']);

    }

    public function safeDown()
    {
    $this->dropPrimaryKey('pk_on_tbl_auth_assignment','{{%auth_assignment}}');
        $this->dropTable('{{%auth_assignment}}');
    }
}
