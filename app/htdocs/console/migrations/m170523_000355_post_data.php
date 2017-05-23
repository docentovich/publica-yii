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
                'id' => $this->primaryKey(10),
                'post_id' => $this->integer(10)->notNull()->comment('fkey'),
                'title' => $this->string(255)->null(),
                'sub_header' => $this->text()->null()->comment('Подзаголовок'),
                'post_short_desc' => $this->string(255)->null()->defaultValue(null),
                'post_desc' => $this->text()->null()->defaultValue(null),
                'post_like_count' => $this->integer(10)->notNull()->defaultValue(0),
                'post_view_count' => $this->integer(15)->notNull()->defaultValue(0),
            ], $this->tableOptions
        );

        $this->createIndex('post_id', '{{%post_data}}', ['post_id'], false);


        $sql = "CREATE TRIGGER `insert_post_data` AFTER INSERT ON {{%post}}
                 FOR EACH ROW INSERT INTO {{%post_data}} SET post_id = NEW.id";
        $this->execute($sql);


    }

    public function safeDown()
    {
        $this->dropTable('{{%post_data}}');
        $sql = "DROP TRIGGER IF EXISTS `insert_post_data`;";
        $this->execute($sql);
    }
}
