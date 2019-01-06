<?php

namespace src\migrations;



class m190103_005544_image extends \src\migrations\Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable(
            '{{%image}}',
            [
                'id'=> $this->primaryKey(10),
                'alt'=> $this->string(70)->null()->defaultValue(null),
                'path'=> $this->string(150)->null()->defaultValue(''),
                'name'=> $this->string(40)->null()->defaultValue(null),
                'desc'=> $this->text()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%image}}');
    }
}
