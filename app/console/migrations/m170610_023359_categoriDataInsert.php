<?php

use yii\db\Schema;
use console\migrations\Migration;

class m170610_023359_categoriDataInsert extends Migration
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
