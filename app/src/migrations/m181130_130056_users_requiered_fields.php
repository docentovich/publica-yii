<?php

use yii\db\Migration;

class m181130_130056_users_requiered_fields extends Migration
{
    public function init()
    {
        $this->db = 'db';
        parent::init();
    }


    public function safeUp()
    {
        $this->alterColumn('{{%usr_user}}', 'email', $this->string(255)->null()->defaultValue(null));
        $this->alterColumn('{{%usr_profile}}', 'firstname', $this->string(100)->null()->defaultValue(null));
    }

    public function safeDown()
    {
        echo "m181130_130056_users_requiered_fields cannot be reverted.\n";

        return true;
    }
}
