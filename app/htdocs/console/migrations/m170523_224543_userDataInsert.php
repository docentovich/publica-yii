<?php

use yii\db\Schema;
use yii\db\Migration;

class m170523_224543_userDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%user}}',
            ["id", "username", "email", "password_hash", "auth_key", "confirmed_at", "unconfirmed_email", "blocked_at", "registration_ip", "created_at", "updated_at", "respond_sms", "respond_email", "flags", "last_login_at"],
            [
                [
                    'id' => '1',
                    'username' => 'admin',
                    'email' => 'admin@tosee.com',
                    'password_hash' => '$2y$10$RfkUUScP7bc6auMT5Y9HP.h2cgra9Q3uZU9K.hLEhzi4VM4WngvHG',
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
                    'last_login_at' => null,
                ],
            ]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%user}} CASCADE');
    }
}
