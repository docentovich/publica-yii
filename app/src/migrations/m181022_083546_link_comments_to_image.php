<?php

use app\migrations\Migration;

class m181022_083546_link_comments_to_image extends Migration
{
    public function safeUp()
    {
        // $tableOptions = 'ENGINE=InnoDB';

        $this->addColumn('{{%comments}}',"image_id", $this->integer(10));
        $this->createIndex('image_id','{{%comments}}',['image_id'],false);

        $this->addForeignKey('fk_tbl_comments_image_id',
            '{{%comments}}','image_id',
            '{{%image}}','id',
            'CASCADE','CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_tbl_comments_image_id', '{{%comments}}');
        $this->dropIndex('image_id', '{{%comments}}');
        $this->dropColumn('{{%comments}}', 'image_id');
    }


}
