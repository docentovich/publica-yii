<?php

use yii\db\Schema;
use yii\db\Migration;

class m170610_022600_social_account extends Migration
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
            '{{%social_account}}',
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
        $this->createIndex('tbl_account_unique','{{%social_account}}',['provider','client_id'],true);
        $this->createIndex('tbl_account_unique_code','{{%social_account}}',['code'],true);
        $this->createIndex('tbl_fk_user_account','{{%social_account}}',['user_id'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('tbl_account_unique', '{{%social_account}}');
        $this->dropIndex('tbl_account_unique_code', '{{%social_account}}');
        $this->dropIndex('tbl_fk_user_account', '{{%social_account}}');
        $this->dropTable('{{%social_account}}');
    }
}
