<?php

namespace users\migrations;



class m190103_005554_usr_token extends \yii\db\Migration
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
            '{{%usr_token}}',
            [
                'user_id'=> $this->integer(11)->notNull(),
                'code'=> $this->string(32)->notNull(),
                'created_at'=> $this->integer(11)->notNull(),
                'type'=> $this->smallInteger(6)->notNull(),
            ],$tableOptions
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
