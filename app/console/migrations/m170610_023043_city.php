<?php

use yii\db\Schema;
use console\migrations\Migration;

class m170610_023043_city extends Migration
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
            '{{%city}}',
            [
                'id'=> $this->primaryKey(10),
                'name'=> $this->string(5)->null()->defaultValue(null),
                'label'=> $this->string(30)->null()->defaultValue(null),
            ],$this->tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%city}}');
    }
}
