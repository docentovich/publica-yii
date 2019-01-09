<?php

namespace src\migrations;


class m190103_005557_Relations extends \src\migrations\Migration
{

    public function init()
    {
       $this->db = 'db';
       parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_tbl_comments_image_id',
            '{{%comments}}','image_id',
            '{{%image}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_comments_user_id',
            '{{%comments}}','user_id',
            '{{%usr_user}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_likes_image_id',
            '{{%likes}}','image_id',
            '{{%image}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_likes_user_id',
            '{{%likes}}','user_id',
            '{{%usr_user}}','id',
            'CASCADE','CASCADE'
         );

    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_tbl_comments_image_id', '{{%comments}}');
        $this->dropForeignKey('fk_tbl_comments_user_id', '{{%comments}}');
        $this->dropForeignKey('fk_tbl_likes_image_id', '{{%likes}}');
        $this->dropForeignKey('fk_tbl_likes_user_id', '{{%likes}}');
    }
}
