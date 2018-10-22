<?php

use yii\db\Migration;

class m181022_122848_likes extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%image}}',"likes", $this->integer(6)->defaultValue(0));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%image}}', 'likes');
    }


}
