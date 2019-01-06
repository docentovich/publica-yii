<?php

namespace tosee\migrations;

class m190103_005550_tosee_post_data extends \yii\db\Migration
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
            '{{%tosee_post_data}}',
            [
                'post_id'=> $this->primaryKey(10)->comment('fkey'),
                'title'=> $this->string(255)->null()->defaultValue(null),
                'sub_header'=> $this->text()->null()->defaultValue(null)->comment('Подзаголовок'),
                'post_short_desc'=> $this->string(255)->null()->defaultValue(null),
                'post_desc'=> $this->text()->null()->defaultValue(null),
                'post_like_count'=> $this->integer(10)->notNull()->defaultValue(0),
                'post_view_count'=> $this->integer(15)->notNull()->defaultValue(0),
            ],$tableOptions
        );
        $this->createIndex('post_id','{{%tosee_post_data}}',['post_id'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('post_id', '{{%tosee_post_data}}');
        $this->dropTable('{{%tosee_post_data}}');
    }
}
