<?php

namespace users\migrations;



class m190103_005557_Relations extends \yii\db\Migration
{

    public function init()
    {
       $this->db = 'db';
       parent::init();
    }

    public function safeUp()
    {

        $this->addForeignKey('fk_tbl_usr_profile_avatar',
            '{{%usr_profile}}','avatar',
            '{{%image}}','id',
            'SET NULL','CASCADE'
         );
        $this->addForeignKey('fk_tbl_usr_profile_user_id',
            '{{%usr_profile}}','user_id',
            '{{%usr_user}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_usr_social_account_user_id',
            '{{%usr_social_account}}','user_id',
            '{{%usr_user}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_usr_token_user_id',
            '{{%usr_token}}','user_id',
            '{{%usr_user}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_usr_user_city_id',
            '{{%usr_user}}','city_id',
            '{{%city}}','id',
            'RESTRICT','CASCADE'
         );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_tbl_usr_profile_avatar', '{{%usr_profile}}');
        $this->dropForeignKey('fk_tbl_usr_profile_user_id', '{{%usr_profile}}');
        $this->dropForeignKey('fk_tbl_usr_social_account_user_id', '{{%usr_social_account}}');
        $this->dropForeignKey('fk_tbl_usr_token_user_id', '{{%usr_token}}');
        $this->dropForeignKey('fk_tbl_usr_user_city_id', '{{%usr_user}}');
    }
}
