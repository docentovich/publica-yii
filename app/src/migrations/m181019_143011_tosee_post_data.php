<?php

use yii\db\Schema;
use app\migrations\Migration;

class m181019_143011_tosee_post_data extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        // $tableOptions = 'ENGINE=InnoDB';

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
            ],$this->tableOptions
        );
        $this->createIndex('post_id','{{%tosee_post_data}}',['post_id'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('post_id', '{{%tosee_post_data}}');
        $this->dropTable('{{%tosee_post_data}}');
    }
}
