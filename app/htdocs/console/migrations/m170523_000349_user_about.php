<?php

use yii\db\Schema;
use console\migrations\Migration;

class m170523_000349_user_about extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        /*$tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%user_about}}',
            [
                'user_id'=> $this->primaryKey(10),
                'about'=> $this->text()->notNull(),
            ],$this->tableOptions
        );*/

    }

    public function safeDown()
    {
        //$this->dropTable('{{%user_about}}');
    }
}
