<?php

use yii\db\Schema;
use app\migrations\Migration;

class m181022_093059_auth_itemDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%auth_item}}',
                           ["name", "type", "description", "rule_name", "data", "created_at", "updated_at"],
                            [
    [
        'name' => 'administrator',
        'type' => '1',
        'description' => null,
        'rule_name' => null,
        'data' => null,
        'created_at' => '1497557956',
        'updated_at' => '1497557956',
    ],
    [
        'name' => 'author',
        'type' => '1',
        'description' => null,
        'rule_name' => null,
        'data' => null,
        'created_at' => '1497557956',
        'updated_at' => '1497557956',
    ],
    [
        'name' => 'changeAuthor',
        'type' => '2',
        'description' => null,
        'rule_name' => null,
        'data' => null,
        'created_at' => '1497557956',
        'updated_at' => '1497557956',
    ],
    [
        'name' => 'changeCityAuthor',
        'type' => '2',
        'description' => null,
        'rule_name' => 'isCityModerator',
        'data' => null,
        'created_at' => '1497557956',
        'updated_at' => '1497557956',
    ],
    [
        'name' => 'changeModerator',
        'type' => '2',
        'description' => null,
        'rule_name' => null,
        'data' => null,
        'created_at' => '1497557956',
        'updated_at' => '1497557956',
    ],
    [
        'name' => 'createPost',
        'type' => '2',
        'description' => null,
        'rule_name' => null,
        'data' => null,
        'created_at' => '1497557956',
        'updated_at' => '1497557956',
    ],
    [
        'name' => 'guest',
        'type' => '1',
        'description' => null,
        'rule_name' => null,
        'data' => null,
        'created_at' => '1497557956',
        'updated_at' => '1497557956',
    ],
    [
        'name' => 'moderateCityPost',
        'type' => '2',
        'description' => null,
        'rule_name' => 'isCityModerator',
        'data' => null,
        'created_at' => '1497557956',
        'updated_at' => '1497557956',
    ],
    [
        'name' => 'moderatePost',
        'type' => '2',
        'description' => null,
        'rule_name' => null,
        'data' => null,
        'created_at' => '1497557956',
        'updated_at' => '1497557956',
    ],
    [
        'name' => 'moderator',
        'type' => '1',
        'description' => null,
        'rule_name' => null,
        'data' => null,
        'created_at' => '1497557956',
        'updated_at' => '1497557956',
    ],
    [
        'name' => 'reedCityPost',
        'type' => '2',
        'description' => null,
        'rule_name' => 'isCityModerator',
        'data' => null,
        'created_at' => '1497557956',
        'updated_at' => '1497557956',
    ],
    [
        'name' => 'reedCityPosts',
        'type' => '2',
        'description' => null,
        'rule_name' => null,
        'data' => null,
        'created_at' => '1497557956',
        'updated_at' => '1497557956',
    ],
    [
        'name' => 'reedOwnPost',
        'type' => '2',
        'description' => null,
        'rule_name' => 'isAuthor',
        'data' => null,
        'created_at' => '1497557956',
        'updated_at' => '1497557956',
    ],
    [
        'name' => 'reedOwnPosts',
        'type' => '2',
        'description' => null,
        'rule_name' => null,
        'data' => null,
        'created_at' => '1497557956',
        'updated_at' => '1497557956',
    ],
    [
        'name' => 'reedPost',
        'type' => '2',
        'description' => null,
        'rule_name' => null,
        'data' => null,
        'created_at' => '1497557956',
        'updated_at' => '1497557956',
    ],
    [
        'name' => 'updateCityPost',
        'type' => '2',
        'description' => null,
        'rule_name' => 'isCityModerator',
        'data' => null,
        'created_at' => '1497557956',
        'updated_at' => '1497557956',
    ],
    [
        'name' => 'updateOwnPost',
        'type' => '2',
        'description' => null,
        'rule_name' => 'isAuthor',
        'data' => null,
        'created_at' => '1497557956',
        'updated_at' => '1497557956',
    ],
    [
        'name' => 'updatePost',
        'type' => '2',
        'description' => null,
        'rule_name' => null,
        'data' => null,
        'created_at' => '1497557956',
        'updated_at' => '1497557956',
    ],
    [
        'name' => 'user',
        'type' => '1',
        'description' => null,
        'rule_name' => null,
        'data' => null,
        'created_at' => '1497557956',
        'updated_at' => '1497557956',
    ],
]
        );
    }

    public function safeDown()
    {
//        $this->truncateTable('{{%auth_item}} CASCADE');
    }
}
