<?php

use yii\db\Schema;
use yii\db\Migration;

class m170610_022559_profile extends Migration
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
            '{{%profile}}',
            [
                'user_id'=> $this->primaryKey(11),
                'name'=> $this->string(255)->null()->defaultValue(null),
                'public_email'=> $this->string(255)->null()->defaultValue(null),
                'gravatar_email'=> $this->string(255)->null()->defaultValue(null),
                'gravatar_id'=> $this->string(32)->null()->defaultValue(null),
                'location'=> $this->string(255)->null()->defaultValue(null),
                'website'=> $this->string(255)->null()->defaultValue(null),
                'bio'=> $this->text()->null()->defaultValue(null),
                'firstname'=> $this->string(100)->notNull(),
                'lastname'=> $this->string(100)->null()->defaultValue(null),
                'sename'=> $this->string(100)->null()->defaultValue(null),
                'phone'=> $this->string(15)->null()->defaultValue(null),
                'avatar'=> $this->integer(10)->notNull(),
                'timezone'=> $this->string(40)->null()->defaultValue(null),
            ],$tableOptions
        );
        $this->createIndex('avatar','{{%profile}}',['avatar'],true);

    }

    public function safeDown()
    {
        $this->dropIndex('avatar', '{{%profile}}');
        $this->dropTable('{{%profile}}');
    }
}
