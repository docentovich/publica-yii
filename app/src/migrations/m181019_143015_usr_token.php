<?php

use yii\db\Schema;
use app\migrations\Migration;

class m181019_143015_usr_token extends Migration
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
            '{{%usr_token}}',
            [
                'user_id'=> $this->integer(11)->notNull(),
                'code'=> $this->string(32)->notNull(),
                'created_at'=> $this->integer(11)->notNull(),
                'type'=> $this->smallInteger(6)->notNull(),
            ],$this->tableOptions
        );
        $this->createIndex('tbl_token_unique','{{%usr_token}}',['user_id','code','type'],true);
        $this->addPrimaryKey('pk_on_tbl_usr_token','{{%usr_token}}',['user_id','code','type']);

    }

    public function safeDown()
    {
    $this->dropPrimaryKey('pk_on_tbl_usr_token','{{%usr_token}}');
        $this->dropIndex('tbl_token_unique', '{{%usr_token}}');
        $this->dropTable('{{%usr_token}}');
    }
}
