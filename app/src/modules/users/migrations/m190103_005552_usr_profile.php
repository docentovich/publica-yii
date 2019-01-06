<?php

namespace users\migrations;

class m190103_005552_usr_profile extends \yii\db\Migration
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
            '{{%usr_profile}}',
            [
                'user_id'=> $this->primaryKey(11),
                'name'=> $this->string(255)->null()->defaultValue(null),
                'public_email'=> $this->string(255)->null()->defaultValue(null),
                'gravatar_email'=> $this->string(255)->null()->defaultValue(null),
                'gravatar_id'=> $this->string(32)->null()->defaultValue(null),
                'location'=> $this->string(255)->null()->defaultValue(null),
                'website'=> $this->string(255)->null()->defaultValue(null),
                'bio'=> $this->text()->null()->defaultValue(null),
                'firstname'=> $this->string(100)->null()->defaultValue(null),
                'lastname'=> $this->string(100)->null()->defaultValue(null),
                'sename'=> $this->string(100)->null()->defaultValue(null),
                'phone'=> $this->string(15)->null()->defaultValue(null),
                'avatar'=> $this->integer(10)->null()->defaultValue(null),
                'timezone'=> $this->string(40)->null()->defaultValue(null),
            ],$tableOptions
        );
        $this->createIndex('avatar','{{%usr_profile}}',['avatar'],true);

    }

    public function safeDown()
    {
        $this->dropIndex('avatar', '{{%usr_profile}}');
        $this->dropTable('{{%usr_profile}}');
    }
}
