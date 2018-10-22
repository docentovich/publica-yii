<?php

use yii\db\Schema;
use app\migrations\Migration;

class m181022_093013_auth_ruleDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%auth_rule}}',
                           ["name", "data", "created_at", "updated_at"],
                            [
    [
        'name' => 'isAuthor',
        'data' => 'O:23:"console\\rbac\\AuthorRule":3:{s:4:"name";s:8:"isAuthor";s:9:"createdAt";i:1497557956;s:9:"updatedAt";i:1497557956;}',
        'created_at' => '1497557956',
        'updated_at' => '1497557956',
    ],
    [
        'name' => 'isCityModerator',
        'data' => 'O:21:"console\\rbac\\CityRule":3:{s:4:"name";s:15:"isCityModerator";s:9:"createdAt";i:1497557956;s:9:"updatedAt";i:1497557956;}',
        'created_at' => '1497557956',
        'updated_at' => '1497557956',
    ],
]
        );
    }

    public function safeDown()
    {
//        $this->truncateTable('{{%auth_rule}} CASCADE');
    }
}
