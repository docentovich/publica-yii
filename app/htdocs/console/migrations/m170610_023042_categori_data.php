<?php

use yii\db\Schema;
use console\migrations\Migration;

class m170610_023042_categori_data extends Migration
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
            '{{%categori_data}}',
            [
                'categori_id'=> $this->primaryKey(10),
                'categori_desc'=> $this->text()->notNull(),
                'categori_short_desc'=> $this->string(255)->notNull(),
            ],$this->tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%categori_data}}');
    }
}
