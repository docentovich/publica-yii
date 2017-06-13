<?php

use yii\db\Schema;
use console\migrations\Migration;

class m170610_023944_profileDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%profile}}',
                           ["user_id", "name", "public_email", "gravatar_email", "gravatar_id", "location", "website", "bio", "firstname", "lastname", "sename", "phone", "avatar", "timezone"],
                            [
    [
        'user_id' => '1',
        'name' => 'Директор',
        'public_email' => null,
        'gravatar_email' => null,
        'gravatar_id' => null,
        'location' => null,
        'website' => null,
        'bio' => '',
        'firstname' => '',
        'lastname' => '',
        'sename' => '',
        'phone' => '',
        'avatar' => '1',
        'timezone' => null,
    ],
    [
        'user_id' => '2',
        'name' => 'Автор',
        'public_email' => null,
        'gravatar_email' => null,
        'gravatar_id' => null,
        'location' => null,
        'website' => null,
        'bio' => '',
        'firstname' => '',
        'lastname' => '',
        'sename' => '',
        'phone' => '',
        'avatar' => '2',
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
