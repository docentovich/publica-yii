<?php

use yii\db\Schema;
//use yii\db\Migration;
use console\migrations\Migration;

class m170523_000347_image extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {

        $this->createTable(
            '{{%image}}',
            [
                'id' => $this->primaryKey(10),
                'alt' => $this->string(70)->null()->defaultValue(null),
                'patch' => $this->string(150)->null()->defaultValue(''),
                'name' => $this->string(40)->notNull(),
                'extension' => $this->char(4)->notNull()->defaultValue('jpg'),
            ],
            $this->tableOptions
        );

        $this->addForeignKey('{{%fk_profile_image}}', '{{%profile}}', 'avatar', '{{%image}}', 'id', $this->cascade, $this->restrict);

        $sql = "CREATE TRIGGER `insert_profile` BEFORE INSERT ON {{%profile}}
                 FOR EACH ROW BEGIN
                DECLARE avatarid INT;
                INSERT INTO {{%image}} SET name = 'noimage';
                SET avatarid = LAST_INSERT_ID();
                SET NEW.avatar = avatarid;
                END
                ";
        $this->execute($sql);


    }

    public function safeDown()
    {
        $this->dropTable('{{%image}}');
    }
}
