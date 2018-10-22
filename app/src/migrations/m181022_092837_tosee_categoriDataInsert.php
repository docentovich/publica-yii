<?php

use yii\db\Schema;
use app\migrations\Migration;

class m181022_092837_tosee_categoriDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%tosee_categori}}',
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
//        $this->truncateTable('{{%tosee_categori}} CASCADE');
    }
}
