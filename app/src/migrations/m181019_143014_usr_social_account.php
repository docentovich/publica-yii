<?php

use yii\db\Schema;
use yii\db\Migration;

class m181019_143014_usr_social_account extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%usr_social_account}}',
            [
                'id'=> $this->primaryKey(11),
                'user_id'=> $this->integer(11)->null()->defaultValue(null),
                'provider'=> $this->string(255)->notNull(),
                'client_id'=> $this->string(255)->notNull(),
                'data'=> $this->text()->null()->defaultValue(null),
                'code'=> $this->string(32)->null()->defaultValue(null),
                'created_at'=> $this->integer(11)->null()->defaultValue(null),
                'email'=> $this->string(255)->null()->defaultValue(null),
                'username'=> $this->string(255)->null()->defaultValue(null),
            ],$tableOptions
        );
        $this->createIndex('tbl_account_unique','{{%usr_social_account}}',['provider','client_id'],true);
        $this->createIndex('tbl_account_unique_code','{{%usr_social_account}}',['code'],true);
        $this->createIndex('tbl_fk_user_account','{{%usr_social_account}}',['user_id'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('tbl_account_unique', '{{%usr_social_account}}');
        $this->dropIndex('tbl_account_unique_code', '{{%usr_social_account}}');
        $this->dropIndex('tbl_fk_user_account', '{{%usr_social_account}}');
        $this->dropTable('{{%usr_social_account}}');
    }
}
