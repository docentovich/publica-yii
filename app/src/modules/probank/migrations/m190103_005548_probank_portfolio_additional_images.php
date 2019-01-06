<?php

namespace probank\migrations;



class m190103_005548_probank_portfolio_additional_images extends \yii\db\Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable(
            '{{%probank_portfolio_additional_images}}',
            [
                'image_id'=> $this->integer(10)->notNull(),
                'portfolio_id'=> $this->integer(10)->notNull(),
                'type'=> "enum('PORTFOLIO', 'SNAP') NOT NULL DEFAULT 'PORTFOLIO'",
            ],$tableOptions
        );
        $this->createIndex('image_id','{{%probank_portfolio_additional_images}}',['image_id'],false);
        $this->createIndex('portfolio_id','{{%probank_portfolio_additional_images}}',['portfolio_id'],false);
        $this->addPrimaryKey('pk_on_tbl_probank_portfolio_additional_images','{{%probank_portfolio_additional_images}}',['image_id','portfolio_id']);

    }

    public function safeDown()
    {
    $this->dropPrimaryKey('pk_on_tbl_probank_portfolio_additional_images','{{%probank_portfolio_additional_images}}');
        $this->dropIndex('image_id', '{{%probank_portfolio_additional_images}}');
        $this->dropIndex('portfolio_id', '{{%probank_portfolio_additional_images}}');
        $this->dropTable('{{%probank_portfolio_additional_images}}');
    }
}
