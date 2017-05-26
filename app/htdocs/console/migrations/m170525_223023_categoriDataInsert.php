<?php

use yii\db\Schema;
use yii\db\Migration;

class m170525_223023_categoriDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%categori}}',
                           ["id", "name"],
                            [
    [
        'id' => '1',
        'name' => 'Без категории',
    ],
]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%categori}} CASCADE');
    }
}
