<?php

use yii\db\Schema;
use yii\db\Migration;

class m170523_000357_Relations extends Migration
{

    public function init()
    {
       $this->db = 'db';
       parent::init();
    }

    public function safeUp()
    {
//        $this->addForeignKey('fk_tbl_user_profile_user_id',
//            '{{%user_profile}}','user_id',
//            '{{%user}}','id',
//            'CASCADE','CASCADE'
//         );
        $this->addForeignKey('fk_tbl_user_about_user_id',
            '{{%user_about}}','user_id',
            '{{%user}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_user_like_user_id',
            '{{%user_like}}','user_id',
            '{{%user}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_post_user_id',
            '{{%post}}','user_id',
            '{{%user}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_post_image_id',
            '{{%post}}','image_id',
            '{{%image}}','id',
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
    }

    public function safeDown()
    {
//        $this->dropForeignKey('fk_tbl_user_profile_user_id', '{{%user_profile}}');
        $this->dropForeignKey('fk_tbl_user_about_user_id', '{{%user_about}}');
        $this->dropForeignKey('fk_tbl_user_like_user_id', '{{%user_like}}');
        $this->dropForeignKey('fk_tbl_post_user_id', '{{%post}}');
        $this->dropForeignKey('fk_tbl_post_image_id', '{{%post}}');
        $this->dropForeignKey('fk_tbl_post_data_post_id', '{{%post_data}}');
        $this->dropForeignKey('fk_tbl_post_to_image_image_id', '{{%post_to_image}}');
        $this->dropForeignKey('fk_tbl_post_to_image_post_id', '{{%post_to_image}}');
    }
}
