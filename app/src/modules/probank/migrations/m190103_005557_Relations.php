<?php

namespace probank\migrations;


class m190103_005557_Relations extends \yii\db\Migration
{

    public function init()
    {
       $this->db = 'db';
       parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_tbl_probank_portfolio_main_photo',
            '{{%probank_portfolio}}','main_photo',
            '{{%image}}','id',
            'SET NULL','CASCADE'
         );
        $this->addForeignKey('fk_tbl_probank_portfolio_user_id',
            '{{%probank_portfolio}}','user_id',
            '{{%usr_user}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_probank_portfolio_additional_images_image_id',
            '{{%probank_portfolio_additional_images}}','image_id',
            '{{%image}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_tbl_probank_portfolio_additional_images_portfolio_id',
            '{{%probank_portfolio_additional_images}}','portfolio_id',
            '{{%probank_portfolio}}','id',
            'CASCADE','CASCADE'
         );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_tbl_probank_portfolio_main_photo', '{{%probank_portfolio}}');
        $this->dropForeignKey('fk_tbl_probank_portfolio_user_id', '{{%probank_portfolio}}');
        $this->dropForeignKey('fk_tbl_probank_portfolio_additional_images_image_id', '{{%probank_portfolio_additional_images}}');
        $this->dropForeignKey('fk_tbl_probank_portfolio_additional_images_portfolio_id', '{{%probank_portfolio_additional_images}}');
    }
}
