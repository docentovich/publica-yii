<?php

use yii\db\Schema;
use app\migrations\Migration;

class m181019_143019_Relations extends Migration
{

    public function init()
    {
       $this->db = 'db';
       parent::init();
    }

    public function safeUp()
    {
//        $this->addForeignKey('fk_tbl_auth_assignment_item_name',
//            '{{%auth_assignment}}','item_name',
//            '{{%auth_item}}','name',
//            'CASCADE','CASCADE'
//         );
//        $this->addForeignKey('fk_tbl_auth_item_rule_name',
//            '{{%auth_item}}','rule_name',
//            '{{%auth_rule}}','name',
//            'CASCADE','CASCADE'
//         );

        $this->addForeignKey('fk_tbl_comments_avatar',
            '{{%comments}}','avatar',
            '{{%image}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_probank_categori_data_categori_id',
            '{{%probank_categori_data}}','categori_id',
            '{{%probank_categori}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_probank_post_post_category_id',
            '{{%probank_post}}','post_category_id',
            '{{%probank_categori}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_probank_post_city_id',
            '{{%probank_post}}','city_id',
            '{{%city}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_probank_post_image_id',
            '{{%probank_post}}','image_id',
            '{{%image}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_probank_post_data_post_id',
            '{{%probank_post_data}}','post_id',
            '{{%probank_post}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_probank_post_to_image_post_id',
            '{{%probank_post_to_image}}','post_id',
            '{{%probank_post}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_probank_post_to_image_image_id',
            '{{%probank_post_to_image}}','image_id',
            '{{%image}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_tosee_categori_data_categori_id',
            '{{%tosee_categori_data}}','categori_id',
            '{{%tosee_categori}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_tosee_post_city_id',
            '{{%tosee_post}}','city_id',
            '{{%city}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_tosee_post_image_id',
            '{{%tosee_post}}','image_id',
            '{{%image}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_tosee_post_user_id',
            '{{%tosee_post}}','user_id',
            '{{%usr_user}}','id',
            'CASCADE','CASCADE'
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
        $this->addForeignKey('fk_tbl_usr_profile_avatar',
            '{{%usr_profile}}','avatar',
            '{{%image}}','id',
            'CASCADE','CASCADE'
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
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_usr_user_like_user_id',
            '{{%usr_user_like}}','user_id',
            '{{%usr_user}}','id',
            'CASCADE','CASCADE'
         );
    }

    public function safeDown()
    {
//        $this->dropForeignKey('fk_tbl_auth_assignment_item_name', '{{%auth_assignment}}');
//        $this->dropForeignKey('fk_tbl_auth_item_rule_name', '{{%auth_item}}');
        $this->dropForeignKey('fk_tbl_comments_avatar', '{{%comments}}');
        $this->dropForeignKey('fk_tbl_probank_categori_data_categori_id', '{{%probank_categori_data}}');
        $this->dropForeignKey('fk_tbl_probank_post_post_category_id', '{{%probank_post}}');
        $this->dropForeignKey('fk_tbl_probank_post_city_id', '{{%probank_post}}');
        $this->dropForeignKey('fk_tbl_probank_post_image_id', '{{%probank_post}}');
        $this->dropForeignKey('fk_tbl_probank_post_data_post_id', '{{%probank_post_data}}');
        $this->dropForeignKey('fk_tbl_probank_post_to_image_post_id', '{{%probank_post_to_image}}');
        $this->dropForeignKey('fk_tbl_probank_post_to_image_image_id', '{{%probank_post_to_image}}');
        $this->dropForeignKey('fk_tbl_tosee_categori_data_categori_id', '{{%tosee_categori_data}}');
        $this->dropForeignKey('fk_tbl_tosee_post_city_id', '{{%tosee_post}}');
        $this->dropForeignKey('fk_tbl_tosee_post_image_id', '{{%tosee_post}}');
        $this->dropForeignKey('fk_tbl_tosee_post_user_id', '{{%tosee_post}}');
        $this->dropForeignKey('fk_tbl_tosee_post_data_post_id', '{{%tosee_post_data}}');
        $this->dropForeignKey('fk_tbl_tosee_post_to_image_image_id', '{{%tosee_post_to_image}}');
        $this->dropForeignKey('fk_tbl_tosee_post_to_image_post_id', '{{%tosee_post_to_image}}');
        $this->dropForeignKey('fk_tbl_usr_profile_avatar', '{{%usr_profile}}');
        $this->dropForeignKey('fk_tbl_usr_profile_user_id', '{{%usr_profile}}');
        $this->dropForeignKey('fk_tbl_usr_social_account_user_id', '{{%usr_social_account}}');
        $this->dropForeignKey('fk_tbl_usr_token_user_id', '{{%usr_token}}');
        $this->dropForeignKey('fk_tbl_usr_user_city_id', '{{%usr_user}}');
        $this->dropForeignKey('fk_tbl_usr_user_like_user_id', '{{%usr_user_like}}');
    }
}
