<?php

use yii\db\Schema;
use console\migrations\Migration;

class m170610_023051_user extends Migration
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
            '{{%user}}',
            [
                'id'=> $this->primaryKey(11),
                'username'=> $this->string(255)->notNull(),
                'email'=> $this->string(255)->notNull(),
                'city_id'=> $this->integer(10)->notNull(),
                'password_hash'=> $this->string(60)->notNull(),
                'auth_key'=> $this->string(32)->notNull(),
                'confirmed_at'=> $this->integer(11)->null()->defaultValue(null),
                'unconfirmed_email'=> $this->string(255)->null()->defaultValue(null),
                'blocked_at'=> $this->integer(11)->null()->defaultValue(null),
                'registration_ip'=> $this->string(45)->null()->defaultValue(null),
                'created_at'=> $this->integer(11)->notNull(),
                'updated_at'=> $this->integer(11)->notNull(),
                'respond_sms'=> $this->smallInteger(1)->notNull()->defaultValue(0),
                'respond_email'=> $this->smallInteger(1)->notNull()->defaultValue(1),
                'flags'=> $this->integer(11)->notNull()->defaultValue(0),
                'last_login_at'=> $this->integer(11)->null()->defaultValue(null),
            ],$this->tableOptions
        );
        $this->createIndex('tbl_user_unique_username','{{%user}}',['username'],true);
        $this->createIndex('tbl_user_unique_email','{{%user}}',['email'],true);
        $this->createIndex('city_id','{{%user}}',['city_id'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('tbl_user_unique_username', '{{%user}}');
        $this->dropIndex('tbl_user_unique_email', '{{%user}}');
        $this->dropIndex('city_id', '{{%user}}');
        $this->dropTable('{{%user}}');
    }
}
