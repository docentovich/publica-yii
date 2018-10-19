<?php

use yii\db\Schema;
use yii\db\Migration;

class m181019_143000_city extends Migration
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
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%city}}');
    }
}
