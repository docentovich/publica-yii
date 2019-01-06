<?php

namespace src\migrations;



class m190103_005543_comments extends \src\migrations\Migration
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
            '{{%comments}}',
            [
                'id'=> $this->primaryKey(11),
                'text'=> $this->text()->null()->defaultValue(null),
                'image_id'=> $this->integer(10)->null()->defaultValue(null),
                'user_id'=> $this->integer(10)->null()->defaultValue(null),
                'title'=> $this->string(255)->null()->defaultValue(''),
            ],$tableOptions
        );
        $this->createIndex('image_id','{{%comments}}',['image_id'],false);
        $this->createIndex('users_id','{{%comments}}',['user_id'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('image_id', '{{%comments}}');
        $this->dropIndex('users_id', '{{%comments}}');
        $this->dropTable('{{%comments}}');
    }
}
