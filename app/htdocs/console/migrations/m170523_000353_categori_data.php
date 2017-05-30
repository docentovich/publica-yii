<?php

use yii\db\Schema;
use console\migrations\Migration;

class m170523_000353_categori_data extends Migration
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
            '{{%categori_data}}',
            [
                'categori_id'=> $this->primaryKey(10),
                'categori_desc'=> $this->text()->notNull(),
                'categori_short_desc'=> $this->string(255)->notNull(),
            ],$this->tableOptions
        );


        $sql = "CREATE TRIGGER `insert_categori_data` AFTER INSERT ON {{%categori}}
                 FOR EACH ROW INSERT INTO {{%categori_data}} SET categori_id = NEW.id";
        $this->execute($sql);

    }

    public function safeDown()
    {
        $this->dropTable('{{%categori_data}}');
    }
}
