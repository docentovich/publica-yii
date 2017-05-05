<?php

use yii\db\Schema;
use yii\db\Migration;

class m170425_003659_tbl_categories extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=MyISAM  CHARSET=utf8';

        $this->createTable('{{%categori}}',[
            'id'=> $this->primaryKey(10),
            'name'=> $this->char(30)->notNull(),
        ], $tableOptions);


        $this->createTable('{{%categoriData}}',[
            'categori_id'=> $this->primaryKey(10),
            'categori_desc'=> $this->text()->notNull(),
            'categori_short_desc'=> $this->string(255)->notNull(),
        ], $tableOptions);

    }

    public function safeDown()
    {
            $this->dropTable('{{%categori}}');
            $this->dropTable('{{%categoriData}}');
    }
}
