<?php

use yii\db\Schema;
use yii\db\Migration;

class m170610_022558_post_to_image extends Migration
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
            '{{%post_to_image}}',
            [
                'post_id'=> $this->integer(10)->notNull(),
                'image_id'=> $this->integer(10)->notNull(),
            ],$tableOptions
        );
        $this->createIndex('post_id','{{%post_to_image}}',['post_id'],false);
        $this->createIndex('image_id','{{%post_to_image}}',['image_id'],false);
        $this->addPrimaryKey('pk_on_tbl_post_to_image','{{%post_to_image}}',['post_id','image_id']);

    }

    public function safeDown()
    {
    $this->dropPrimaryKey('pk_on_tbl_post_to_image','{{%post_to_image}}');
        $this->dropIndex('post_id', '{{%post_to_image}}');
        $this->dropIndex('image_id', '{{%post_to_image}}');
        $this->dropTable('{{%post_to_image}}');
    }
}
