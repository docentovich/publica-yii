<?php

namespace probank\migrations;


class m190103_005547_probank_portfolio extends \yii\db\Migration
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
            '{{%probank_portfolio}}',
            [
                'id'=> $this->primaryKey(10),
                'about'=> $this->text()->null()->defaultValue(null),
                'price'=> $this->float()->null()->defaultValue(null),
                'main_photo'=> $this->integer(10)->null()->defaultValue(null),
                'user_id'=> $this->integer(10)->null()->defaultValue(null),
                'type'=> "enum('MODEL', 'PHOTOGRAPHER') NOT NULL DEFAULT 'MODEL'",
                'created_at'=> $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
                'modified_at'=> $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
            ],$tableOptions
        );
        $this->createIndex('user_id_2','{{%probank_portfolio}}',['user_id','type'],true);
        $this->createIndex('main_photo','{{%probank_portfolio}}',['main_photo'],false);
        $this->createIndex('user_id','{{%probank_portfolio}}',['user_id'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('user_id_2', '{{%probank_portfolio}}');
        $this->dropIndex('main_photo', '{{%probank_portfolio}}');
        $this->dropIndex('user_id', '{{%probank_portfolio}}');
        $this->dropTable('{{%probank_portfolio}}');
    }
}
