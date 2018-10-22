<?php


class m181022_105021_rbac extends \app\migrations\Migration
{
    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%auth_item_child}}',
            ["parent", "child"],
            [
                [
                    'parent' => 'moderator',
                    'child' => 'author',
                ],
                [
                    'parent' => 'administrator',
                    'child' => 'changeAuthor',
                ],
                [
                    'parent' => 'changeCityAuthor',
                    'child' => 'changeAuthor',
                ],
                [
                    'parent' => 'moderator',
                    'child' => 'changeCityAuthor',
                ],
                [
                    'parent' => 'administrator',
                    'child' => 'changeModerator',
                ],
                [
                    'parent' => 'administrator',
                    'child' => 'createPost',
                ],
                [
                    'parent' => 'author',
                    'child' => 'createPost',
                ],
                [
                    'parent' => 'moderator',
                    'child' => 'createPost',
                ],
                [
                    'parent' => 'user',
                    'child' => 'guest',
                ],
                [
                    'parent' => 'moderator',
                    'child' => 'moderateCityPost',
                ],
                [
                    'parent' => 'administrator',
                    'child' => 'moderatePost',
                ],
                [
                    'parent' => 'moderateCityPost',
                    'child' => 'moderatePost',
                ],
                [
                    'parent' => 'administrator',
                    'child' => 'moderator',
                ],
                [
                    'parent' => 'moderator',
                    'child' => 'reedCityPost',
                ],
                [
                    'parent' => 'moderator',
                    'child' => 'reedCityPosts',
                ],
                [
                    'parent' => 'reedCityPost',
                    'child' => 'reedCityPosts',
                ],
                [
                    'parent' => 'author',
                    'child' => 'reedOwnPost',
                ],
                [
                    'parent' => 'author',
                    'child' => 'reedOwnPosts',
                ],
                [
                    'parent' => 'reedOwnPost',
                    'child' => 'reedOwnPosts',
                ],
                [
                    'parent' => 'administrator',
                    'child' => 'reedPost',
                ],
                [
                    'parent' => 'reedCityPosts',
                    'child' => 'reedPost',
                ],
                [
                    'parent' => 'reedOwnPosts',
                    'child' => 'reedPost',
                ],
                [
                    'parent' => 'moderator',
                    'child' => 'updateCityPost',
                ],
                [
                    'parent' => 'author',
                    'child' => 'updateOwnPost',
                ],
                [
                    'parent' => 'moderator',
                    'child' => 'updateOwnPost',
                ],
                [
                    'parent' => 'administrator',
                    'child' => 'updatePost',
                ],
                [
                    'parent' => 'updateCityPost',
                    'child' => 'updatePost',
                ],
                [
                    'parent' => 'updateOwnPost',
                    'child' => 'updatePost',
                ],
                [
                    'parent' => 'author',
                    'child' => 'user',
                ],
            ]
        );

        $this->addForeignKey('fk_tbl_auth_item_child_child',
            '{{%auth_item_child}}','child',
            '{{%auth_item}}','name',
            'CASCADE','CASCADE'
        );
        $this->addForeignKey('fk_tbl_auth_item_child_parent',
            '{{%auth_item_child}}','parent',
            '{{%auth_item}}','name',
            'CASCADE','CASCADE'
        );

    }

    public function safeDown()
    {
//        $this->truncateTable('{{%auth_item_child}} CASCADE');

        $this->dropForeignKey('fk_tbl_auth_item_child_child', '{{%auth_item_child}}');
        $this->dropForeignKey('fk_tbl_auth_item_child_parent', '{{%auth_item_child}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181022_105021_rbac cannot be reverted.\n";

        return false;
    }
    */
}
