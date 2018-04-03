<?php

use yii\db\Schema;
use console\migrations\Migration;

class m170610_023933_imageDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
//        $this->batchInsert('{{%image}}',
//                           ["id", "alt", "patch", "name"],
//                            [
//    [
//        'id' => '1',
//        'alt' => null,
//        'patch' => '',
//        'name' => 'noimage.png',
//    ],
//    [
//        'id' => '2',
//        'alt' => null,
//        'patch' => '',
//        'name' => 'noimage.png',
//    ],
//]
//        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%image}} CASCADE');
    }
}
