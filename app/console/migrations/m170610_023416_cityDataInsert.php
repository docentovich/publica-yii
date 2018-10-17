<?php

use yii\db\Schema;
use console\migrations\Migration;

class m170610_023416_cityDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%city}}',
                           ["id", "name", "label"],
                            [
    [
        'id' => '1',
        'name' => 'orl',
        'label' => 'Орел',
    ],
    [
        'id' => '2',
        'name' => 'spb',
        'label' => 'Санкт-Петербург',
    ],
]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%city}} CASCADE');
    }
}
