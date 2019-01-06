<?php

namespace users\migrations;


class m190103_143734_usr_profileDataInsert extends \yii\db\Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%usr_profile}}',
            ["user_id", "name", "public_email", "gravatar_email", "gravatar_id", "location", "website", "bio", "firstname", "lastname", "sename", "phone", "avatar", "timezone"],
            [
                [
                    'user_id' => '1',
                    'name' => 'admin',
                    'public_email' => null,
                    'gravatar_email' => null,
                    'gravatar_id' => null,
                    'location' => null,
                    'website' => null,
                    'bio' => null,
                    'firstname' => null,
                    'lastname' => null,
                    'sename' => null,
                    'phone' => null,
                    'avatar' => null,
                    'timezone' => null,
                ]
            ]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%usr_profile}} CASCADE');
    }
}
