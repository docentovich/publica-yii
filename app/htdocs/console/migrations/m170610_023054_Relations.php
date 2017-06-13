<?php

use yii\db\Schema;
use console\migrations\Migration;

class m170610_023054_Relations extends Migration
{

    public function init()
    {
       $this->db = 'db';
       parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_tbl_auth_assignment_item_name',
            '{{%auth_assignment}}','item_name',
            '{{%auth_item}}','name',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_auth_item_rule_name',
            '{{%auth_item}}','rule_name',
            '{{%auth_rule}}','name',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_auth_item_child_parent',
            '{{%auth_item_child}}','parent',
            '{{%auth_item}}','name',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_auth_item_child_child',
            '{{%auth_item_child}}','child',
            '{{%auth_item}}','name',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_categori_data_categori_id',
            '{{%categori_data}}','categori_id',
            '{{%categori}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_post_image_id',
            '{{%post}}','image_id',
            '{{%image}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_post_user_id',
            '{{%post}}','user_id',
            '{{%user}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_post_city_id',
            '{{%post}}','city_id',
            '{{%city}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_post_data_post_id',
            '{{%post_data}}','post_id',
            '{{%post}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_post_to_image_image_id',
            '{{%post_to_image}}','image_id',
            '{{%image}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_post_to_image_post_id',
            '{{%post_to_image}}','post_id',
            '{{%post}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_profile_avatar',
            '{{%profile}}','avatar',
            '{{%image}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_profile_user_id',
            '{{%profile}}','user_id',
            '{{%user}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_social_account_user_id',
            '{{%social_account}}','user_id',
            '{{%user}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_token_user_id',
            '{{%token}}','user_id',
            '{{%user}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_user_city_id',
            '{{%user}}','city_id',
            '{{%city}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_user_like_user_id',
            '{{%user_like}}','user_id',
            '{{%user}}','id',
            'CASCADE','CASCADE'
         );

        $sql = "CREATE TRIGGER `insert_profile` BEFORE INSERT ON {{%profile}}
                 FOR EACH ROW BEGIN
                DECLARE avatarid INT;
                INSERT INTO {{%image}} SET name = 'noimage.png';
                SET avatarid = LAST_INSERT_ID();
                SET NEW.avatar = avatarid;
                END
                ";
        $this->execute($sql);
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_tbl_auth_assignment_item_name', '{{%auth_assignment}}');
        $this->dropForeignKey('fk_tbl_auth_item_rule_name', '{{%auth_item}}');
        $this->dropForeignKey('fk_tbl_auth_item_child_parent', '{{%auth_item_child}}');
        $this->dropForeignKey('fk_tbl_auth_item_child_child', '{{%auth_item_child}}');
        $this->dropForeignKey('fk_tbl_categori_data_categori_id', '{{%categori_data}}');
        $this->dropForeignKey('fk_tbl_post_image_id', '{{%post}}');
        $this->dropForeignKey('fk_tbl_post_user_id', '{{%post}}');
        $this->dropForeignKey('fk_tbl_post_city_id', '{{%post}}');
        $this->dropForeignKey('fk_tbl_post_data_post_id', '{{%post_data}}');
        $this->dropForeignKey('fk_tbl_post_to_image_image_id', '{{%post_to_image}}');
        $this->dropForeignKey('fk_tbl_post_to_image_post_id', '{{%post_to_image}}');
        $this->dropForeignKey('fk_tbl_profile_avatar', '{{%profile}}');
        $this->dropForeignKey('fk_tbl_profile_user_id', '{{%profile}}');
        $this->dropForeignKey('fk_tbl_social_account_user_id', '{{%social_account}}');
        $this->dropForeignKey('fk_tbl_token_user_id', '{{%token}}');
        $this->dropForeignKey('fk_tbl_user_city_id', '{{%user}}');
        $this->dropForeignKey('fk_tbl_user_like_user_id', '{{%user_like}}');
    }
}
