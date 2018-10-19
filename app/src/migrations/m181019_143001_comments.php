<?php

use yii\db\Schema;
use yii\db\Migration;

class m181019_143001_comments extends Migration
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
            '{{%comments}}',
            [
                'id'=> $this->primaryKey(11),
                'avatar'=> $this->integer(10)->null()->defaultValue(null),
                'title'=> $this->string(255)->notNull(),
                'text'=> $this->text()->notNull(),
            ],$tableOptions
        );
        $this->createIndex('avatar','{{%comments}}',['avatar'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('avatar', '{{%comments}}');
        $this->dropTable('{{%comments}}');
    }
}
