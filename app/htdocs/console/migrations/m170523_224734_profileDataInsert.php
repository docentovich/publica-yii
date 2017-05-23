<?php

use yii\db\Schema;
use yii\db\Migration;

class m170523_224734_profileDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%profile}}',
                           ["user_id", "name", "public_email", "gravatar_email", "gravatar_id", "location", "website", "bio", "timezone"],
                            [
    [
        'user_id' => '1',
        'name' => null,
        'public_email' => null,
        'gravatar_email' => null,
        'gravatar_id' => null,
        'location' => null,
        'website' => null,
        'bio' => null,
        'timezone' => null,
    ],
]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%profile}} CASCADE');
    }
}
