<?php

use yii\db\Schema;
use yii\db\Migration;

class m170525_223244_categori_dataDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
//        $this->batchInsert('{{%categori_data}}',
//            ["categori_id", "categori_desc", "categori_short_desc"],
//            [
//                [
//                    'categori_id' => '1',
//                    'categori_desc' => '',
//                    'categori_short_desc' => '',
//                ],
//            ]
//        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%categori_data}} CASCADE');
    }
}
