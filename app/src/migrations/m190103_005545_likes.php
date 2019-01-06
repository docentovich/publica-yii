<?php

namespace src\migrations;



class m190103_005545_likes extends \src\migrations\Migration
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
            '{{%likes}}',
            [
                'user_id'=> $this->integer(11)->notNull(),
                'image_id'=> $this->integer(10)->notNull(),
            ],$tableOptions
        );
        $this->createIndex('user_id','{{%likes}}',['user_id'],false);
        $this->createIndex('image_id','{{%likes}}',['image_id'],false);
        $this->addPrimaryKey('pk_on_tbl_likes','{{%likes}}',['user_id','image_id']);

    }

    public function safeDown()
    {
    $this->dropPrimaryKey('pk_on_tbl_likes','{{%likes}}');
        $this->dropIndex('user_id', '{{%likes}}');
        $this->dropIndex('image_id', '{{%likes}}');
        $this->dropTable('{{%likes}}');
    }
}
