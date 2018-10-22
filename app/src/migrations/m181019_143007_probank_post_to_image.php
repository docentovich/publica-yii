<?php

use yii\db\Schema;
use app\migrations\Migration;

class m181019_143007_probank_post_to_image extends Migration
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
            '{{%probank_post_to_image}}',
            [
                'post_id'=> $this->integer(10)->notNull(),
                'image_id'=> $this->integer(10)->notNull(),
            ],$this->tableOptions
        );
        $this->createIndex('post_id','{{%probank_post_to_image}}',['post_id'],false);
        $this->createIndex('image_id','{{%probank_post_to_image}}',['image_id'],false);
        $this->addPrimaryKey('pk_on_tbl_probank_post_to_image','{{%probank_post_to_image}}',['post_id','image_id']);

    }

    public function safeDown()
    {
    $this->dropPrimaryKey('pk_on_tbl_probank_post_to_image','{{%probank_post_to_image}}');
        $this->dropIndex('post_id', '{{%probank_post_to_image}}');
        $this->dropIndex('image_id', '{{%probank_post_to_image}}');
        $this->dropTable('{{%probank_post_to_image}}');
    }
}
