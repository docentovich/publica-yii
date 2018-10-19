<?php

use yii\db\Schema;
use yii\db\Migration;

class m181019_143018_usr_user_like extends Migration
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
            '{{%usr_user_like}}',
            [
                'user_id'=> $this->integer(10)->notNull(),
                'model'=> $this->char(10)->notNull()->comment('Ссылка на модель'),
                'item_id'=> $this->integer(10)->notNull(),
            ],$tableOptions
        );
        $this->addPrimaryKey('pk_on_tbl_usr_user_like','{{%usr_user_like}}',['user_id','model','item_id']);

    }

    public function safeDown()
    {
    $this->dropPrimaryKey('pk_on_tbl_usr_user_like','{{%usr_user_like}}');
        $this->dropTable('{{%usr_user_like}}');
    }
}
