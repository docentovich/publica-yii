<?php

namespace DateTimePlanner\migrations;

use yii\db\Schema;
use yii\db\Migration;

class m190103_190607_tbl_date_time_planner extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%date_time_planner}}',[
            'id'=> $this->primaryKey(10),
            'date'=> $this->date()->notNull(),
            'time'=> "enum('0-2', '2-4', '4-6', '6-8', '8-10', '10-12', '12-14', '14-16', '16-18', '18-20', '20-22', '22-24') NOT NULL",
            'user_id'=> $this->integer(10)->notNull(),
        ], $tableOptions);

        $this->createIndex('date','{{%date_time_planner}}',['date','time','user_id'],true);
        $this->createIndex('user_id','{{%date_time_planner}}',['user_id'],false);
        $this->addForeignKey(
            'fk_tbl_date_time_planner_user_id',
            '{{%date_time_planner}}', 'user_id',
            '{{%usr_user}}', 'id',
            'CASCADE', 'CASCADE'
        );
    }

    public function safeDown()
    {
            $this->dropForeignKey('fk_tbl_date_time_planner_user_id', '{{%date_time_planner}}');
            $this->dropTable('{{%date_time_planner}}');
    }
}
