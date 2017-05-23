<?php

use yii\db\Schema;
use yii\db\Migration;

class m170523_000348_user_profile extends Migration
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
            '{{%user_profile}}',
            [
                'user_id'=> $this->integer(10)->notNull(),
                'avatar'=> $this->integer(10)->notNull()->defaultValue(1)->comment('ссылка на ресурс'),
                'respond_sms'=> $this->smallInteger(1)->notNull()->defaultValue(0),
                'respond_email'=> $this->smallInteger(1)->notNull()->defaultValue(1),
                'firstname'=> $this->string(100)->notNull(),
                'lastname'=> $this->integer(100)->null()->defaultValue(null),
                'phone'=> $this->integer(15)->null()->defaultValue(null),
                'sename'=> $this->integer(100)->null()->defaultValue(null),
            ],$tableOptions
        );
        $this->createIndex('user_id','{{%user_profile}}',['user_id'],false);
        $this->createIndex('avatar','{{%user_profile}}',['avatar'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('user_id', '{{%user_profile}}');
        $this->dropIndex('avatar', '{{%user_profile}}');
        $this->dropTable('{{%user_profile}}');
    }
}
