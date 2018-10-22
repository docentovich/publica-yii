<?php

use yii\db\Schema;
use app\migrations\Migration;

class m181022_093126_auth_assignmentDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%auth_assignment}}',
            ["item_name", "user_id", "created_at"],
            [
                [
                    'item_name' => 'administrator',
                    'user_id' => '1',
                    'created_at' => '1497557956',
                ]
            ]
        );
    }

    public function safeDown()
    {
//        $this->truncateTable('{{%auth_assignment}} CASCADE');
    }
}
