<?php

namespace src\migrations;


class m190103_143534_cityDataInsert  extends \src\migrations\Migration
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
        'label' => 'Orel',
    ],
    [
        'id' => '2',
        'name' => 'spb',
        'label' => 'Saint-Petersburg',
    ],
]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%city}} CASCADE');
    }
}
