<?php

namespace tosee\migrations;


class m190103_005557_Relations extends \yii\db\Migration
{

    public function init()
    {
       $this->db = 'db';
       parent::init();
    }

    public function safeUp()
    {

        $this->addForeignKey('fk_tbl_tosee_post_image_id',
            '{{%tosee_post}}','image_id',
            '{{%image}}','id',
            'SET NULL','CASCADE'
         );
        $this->addForeignKey('fk_tbl_tosee_post_city_id',
            '{{%tosee_post}}','city_id',
            '{{%city}}','id',
            'RESTRICT','CASCADE'
         );
        $this->addForeignKey('fk_tbl_tosee_post_user_id',
            '{{%tosee_post}}','user_id',
            '{{%usr_user}}','id',
            'SET NULL','CASCADE'
         );
        $this->addForeignKey('fk_tbl_tosee_post_data_post_id',
            '{{%tosee_post_data}}','post_id',
            '{{%tosee_post}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_tosee_post_to_image_image_id',
            '{{%tosee_post_to_image}}','image_id',
            '{{%image}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_tosee_post_to_image_post_id',
            '{{%tosee_post_to_image}}','post_id',
            '{{%tosee_post}}','id',
            'CASCADE','CASCADE'
         );

    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_tbl_tosee_post_image_id', '{{%tosee_post}}');
        $this->dropForeignKey('fk_tbl_tosee_post_city_id', '{{%tosee_post}}');
        $this->dropForeignKey('fk_tbl_tosee_post_user_id', '{{%tosee_post}}');
        $this->dropForeignKey('fk_tbl_tosee_post_data_post_id', '{{%tosee_post_data}}');
        $this->dropForeignKey('fk_tbl_tosee_post_to_image_image_id', '{{%tosee_post_to_image}}');
        $this->dropForeignKey('fk_tbl_tosee_post_to_image_post_id', '{{%tosee_post_to_image}}');
    }
}
