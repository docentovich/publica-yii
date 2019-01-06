<?php

namespace users\migrations;


class m190103_143633_usr_userDataInsert extends \yii\db\Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%usr_user}}',
            ["id", "username", "email", "city_id", "password_hash", "auth_key", "confirmed_at", "unconfirmed_email", "blocked_at", "registration_ip", "created_at", "updated_at", "respond_sms", "respond_email", "flags", "last_login_at", "status"],
            [
                [
                    'id' => '1',
                    'username' => 'admin',
                    'email' => 'admin@tosee.com',
                    'city_id' => '1',
                    'password_hash' => '$2y$13$kg8MeeevsH19H4q8e7Nqu.2CSSSxZgSh6/9SYaptkB7sJKIzmWuke',
                    'auth_key' => 'afx4DQVHxQ25-wSkjcLN_MIoEJdLLVqO',
                    'confirmed_at' => '1495579273',
                    'unconfirmed_email' => null,
                    'blocked_at' => null,
                    'registration_ip' => '192.168.99.1',
                    'created_at' => '1495579262',
                    'updated_at' => '1540846373',
                    'respond_sms' => '0',
                    'respond_email' => '1',
                    'flags' => '0',
                    'last_login_at' => '1543349850',
                    'status' => '10',
                ]
            ]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%usr_user}} CASCADE');
    }
}
