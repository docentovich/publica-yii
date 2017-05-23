<?php

use yii\db\Schema;
use console\migrations\Migration;

class m170523_000355_post_data extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%post_data}}',
            [
                'post_id'=> $this->primaryKey(10)->comment('fkey'),
                'title'=> $this->string(255)->notNull(),
                'sub_header'=> $this->text()->notNull()->comment('Подзаголовок'),
                'post_short_desc'=> $this->string(255)->null()->defaultValue(null),
                'post_desc'=> $this->text()->null()->defaultValue(null),
                'post_like_count'=> $this->integer(10)->notNull()->defaultValue(0),
                'post_view_count'=> $this->integer(15)->notNull()->defaultValue(0),
            ],$this->tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%post_data}}');
    }
}
