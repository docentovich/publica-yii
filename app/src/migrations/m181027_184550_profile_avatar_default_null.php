<?php

use yii\db\Migration;

class m181027_184550_profile_avatar_default_null extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('{{%usr_profile}}', 'avatar', $this->integer(10)->null()->defaultValue(null));
    }

    public function safeDown()
    {
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181027_184550_profile_avtar_default_null cannot be reverted.\n";

        return false;
    }
    */
}
