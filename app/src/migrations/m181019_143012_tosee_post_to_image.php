<?php

use yii\db\Schema;
use yii\db\Migration;

class m181019_143012_tosee_post_to_image extends Migration
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
            '{{%tosee_post_to_image}}',
            [
                'post_id'=> $this->integer(10)->notNull(),
                'image_id'=> $this->integer(10)->notNull(),
            ],$tableOptions
        );
        $this->createIndex('post_id','{{%tosee_post_to_image}}',['post_id'],false);
        $this->createIndex('image_id','{{%tosee_post_to_image}}',['image_id'],false);
        $this->addPrimaryKey('pk_on_tbl_tosee_post_to_image','{{%tosee_post_to_image}}',['post_id','image_id']);

    }

    public function safeDown()
    {
    $this->dropPrimaryKey('pk_on_tbl_tosee_post_to_image','{{%tosee_post_to_image}}');
        $this->dropIndex('post_id', '{{%tosee_post_to_image}}');
        $this->dropIndex('image_id', '{{%tosee_post_to_image}}');
        $this->dropTable('{{%tosee_post_to_image}}');
    }
}
