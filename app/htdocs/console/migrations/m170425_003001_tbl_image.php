<?php

use yii\db\Schema;
use yii\db\Migration;

class m170425_003001_tbl_image extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB  CHARSET=utf8';

        $this->createTable('{{%image}}',[
            'id'=> $this->primaryKey(10),
            'user_id'=> $this->integer(10)->notNull()->comment('Владелец. fkey'),
            'thumbnail'=> $this->char(32)->notNull(),
            'src'=> $this->char(32)->notNull(),
            'extension'=> $this->char(4)->notNull()->defaultValue('jpg'),
            'alt'=> $this->string(70)->null()->defaultValue(null),
        ], $tableOptions);

        $this->createIndex('user_id','{{%image}}',['user_id'],false);
        $this->addForeignKey(
            'fk_tbl_image_user_id',
            '{{%image}}', 'user_id',
            '{{%user}}', 'id',
            'CASCADE', 'CASCADE'
        );
    }

    public function safeDown()
    {
            $this->dropForeignKey('fk_tbl_image_user_id', '{{%image}}');
            $this->dropTable('{{%image}}');
    }
}
