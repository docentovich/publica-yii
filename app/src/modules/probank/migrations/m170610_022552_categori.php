<?php

use yii\db\Schema;
use yii\db\Migration;

class m170610_022552_categori extends Migration
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
            '{{%categori}}',
            [
                'id'=> $this->primaryKey(10),
                'name'=> $this->char(30)->notNull(),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%categori}}');
    }
}
