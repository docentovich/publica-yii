<?php

use yii\db\Schema;
use console\migrations\Migration;

class m170610_023442_userDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%user}}',
                           ["id", "username", "email", "city_id", "password_hash", "auth_key", "confirmed_at", "unconfirmed_email", "blocked_at", "registration_ip", "created_at", "updated_at", "respond_sms", "respond_email", "flags", "last_login_at"],
                            [
    [
        'id' => '1',
        'username' => 'admin',
        'email' => 'admin@tosee.com',
        'city_id' => '1',
        'password_hash' => '$2y$10$XpyGadI3.HTKjhxl9HZHCOnTXVzwdyDNlMp9YAGTjKFstbpD2NjIy',
        'auth_key' => 'afx4DQVHxQ25-wSkjcLN_MIoEJdLLVqO',
        'confirmed_at' => '1495579273',
        'unconfirmed_email' => null,
        'blocked_at' => null,
        'registration_ip' => '192.168.99.1',
        'created_at' => '1495579262',
        'updated_at' => '1495579262',
        'respond_sms' => '0',
        'respond_email' => '1',
        'flags' => '0',
        'last_login_at' => '1497041567',
    ],
    [
        'id' => '2',
        'username' => 'andrey',
        'email' => 'adsd@sdsdf.ru',
        'city_id' => '1',
        'password_hash' => '$2y$10$5LDHyEah7VA5WgvQJvoZE.4niWt43TWoluZqG6o2S1V1Pfq5BGja.',
        'auth_key' => 'MknBR7sw7wy-L07e1VqwWXF5VzU4cA7d',
        'confirmed_at' => '1496589202',
        'unconfirmed_email' => null,
        'blocked_at' => null,
        'registration_ip' => '192.168.99.1',
        'created_at' => '1496589188',
        'updated_at' => '1496589188',
        'respond_sms' => '0',
        'respond_email' => '1',
        'flags' => '0',
        'last_login_at' => '1497053277',
    ],
]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%user}} CASCADE');
    }
}
