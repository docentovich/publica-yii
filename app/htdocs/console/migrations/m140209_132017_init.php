<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use dektrium\user\migrations\Migration;

/**
 * @author Dmitry Erofeev <dmeroff@gmail.com
 */
class m140209_132017_init extends Migration
{
    public function up()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(25)->notNull(),
            'email' => $this->string(255)->notNull(),
            'password_hash' => $this->string(60)->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'confirmation_token' => $this->string(32)->null(),
            'confirmation_sent_at' => $this->integer()->null(),
            'confirmed_at' => $this->integer()->null(),
            'unconfirmed_email' => $this->string(255)->null(),
            'recovery_token' => $this->string(32)->null(),
            'recovery_sent_at' => $this->integer()->null(),
            'blocked_at' => $this->integer()->null(),
            'registered_from' => $this->integer()->null(),
            'logged_in_from' => $this->integer()->null(),
            'logged_in_at' => $this->integer()->null(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'respond_sms' => $this->smallInteger(1)->notNull()->defaultValue(0),
            'respond_email' => $this->smallInteger(1)->notNull()->defaultValue(1),

        ], $this->tableOptions);

        $this->createIndex('{{%user_unique_username}}', '{{%user}}', 'username', true);
        $this->createIndex('{{%user_unique_email}}', '{{%user}}', 'email', true);
        $this->createIndex('{{%user_confirmation}}', '{{%user}}', 'id, confirmation_token', true);
        $this->createIndex('{{%user_recovery}}', '{{%user}}', 'id, recovery_token', true);

        $this->createTable('{{%profile}}', [
            'user_id' => $this->integer()->notNull()->append('PRIMARY KEY'),
            'name' => $this->string(255)->null(),
            'public_email' => $this->string(255)->null(),
            'gravatar_email' => $this->string(255)->null(),
            'gravatar_id' => $this->string(32)->null(),
            'location' => $this->string(255)->null(),
            'website' => $this->string(255)->null(),
            'bio' => $this->text()->null(),
            'firstname' => $this->string(100)->notNull(),
            'lastname' => $this->string(100)->null()->defaultValue(null),
            'sename' => $this->string(100)->null()->defaultValue(null),
            'phone' => $this->string(15)->null()->defaultValue(null),
            'avatar' => $this->integer(10)->notNull(),
        ], $this->tableOptions);

        $this->createIndex('avatar', '{{%profile}}', ['avatar'], true);


        $this->addForeignKey('{{%fk_user_profile}}', '{{%profile}}', 'user_id', '{{%user}}', 'id', $this->cascade, $this->restrict);


//        //юзер 1
//        $this->batchInsert('{{%user}}',
//            ["id", "username", "email", "password_hash", "auth_key", "confirmed_at", "unconfirmed_email", "blocked_at", "registration_ip", "created_at", "updated_at", "user_id", "avatar", "respond_sms", "respond_email", "firstname", "lastname", "phone", "sename", "flags", "last_login_at"],
//            [
//                [
//                    'id' => '1',
//                    'username' => 'admin',
//                    'email' => 'admin@tosee.com',
//                    'password_hash' => '$2y$10$0489YIkI6.50TgXZhDa/GODzewxCO4jk4mZemZrro.twc3mD4Cgqe',
//                    'auth_key' => '-bVn3nCxqYpK60Pv1kOVvJo7lOv8MT-h',
//                    'confirmed_at' => '1495575848',
//                    'unconfirmed_email' => null,
//                    'blocked_at' => null,
//                    'created_at' => '1495575354',
//                    'updated_at' => '1495575354',
//                    'user_id' => '0',
//                    'avatar' => '1',
//                    'respond_sms' => '0',
//                    'respond_email' => '1',
//                    'firstname' => '',
//                    'lastname' => null,
//                    'phone' => null,
//                    'sename' => null,
//                    'flags' => '0',
//                    'last_login_at' => null,
//                ],
//            ]
//        );
//
//        //его профиль
//        $this->batchInsert('{{%profile}}',
//            ["user_id", "name", "public_email", "gravatar_email", "gravatar_id", "location", "website", "bio", "timezone"],
//            [
//                [
//                    'user_id' => '1',
//                    'name' => null,
//                    'public_email' => null,
//                    'gravatar_email' => null,
//                    'gravatar_id' => null,
//                    'location' => null,
//                    'website' => null,
//                    'bio' => null,
//                    'timezone' => null,
//                ],
//            ]
//        );
    }

    public function down()
    {
        $this->dropTable('{{%profile}}');
        $this->dropTable('{{%user}}');
    }
}
