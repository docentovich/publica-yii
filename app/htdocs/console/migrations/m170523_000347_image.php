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

        $this->batchInsert('{{%image}}',
            ["id", "alt", "patch", "name", "extension"],
            [
                [
                    'id' => '1',
                    'alt' => 'noimage',
                    'patch' => '',
                    'name' => 'noimage',
                    'extension' => 'jpg',
                ],
            ]
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%image}}');
    }
}
