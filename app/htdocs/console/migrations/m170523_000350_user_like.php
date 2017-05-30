<?php

use yii\db\Schema;
use console\migrations\Migration;

class m170523_000350_user_like extends Migration
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
            '{{%user_like}}',
            [
                'user_id'=> $this->integer(10)->notNull(),
                'model'=> $this->char(10)->notNull()->comment('Ссылка на модель'),
                'item_id'=> $this->integer(10)->notNull(),
            ],$this->tableOptions
        );
        $this->addPrimaryKey('pk_on_tbl_user_like','{{%user_like}}',['user_id','model','item_id']);

    }

    public function safeDown()
    {
    $this->dropPrimaryKey('pk_on_tbl_user_like','{{%user_like}}');
        $this->dropTable('{{%user_like}}');
    }
}
