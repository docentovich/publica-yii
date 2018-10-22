<?php

use yii\db\Schema;
use app\migrations\Migration;

class m181019_143002_image extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        // $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%image}}',
            [
                'id'=> $this->primaryKey(10),
                'alt'=> $this->string(70)->null()->defaultValue(null),
                'path'=> $this->string(150)->null()->defaultValue(''),
                'name'=> $this->string(40)->null()->defaultValue(null),
            ],$this->tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%image}}');
    }
}
