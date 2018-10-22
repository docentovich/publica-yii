<?php

use yii\db\Migration;

class m181022_143115_image_desc extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%image}}',"desc", $this->text());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%image}}', 'desc');
    }
}
