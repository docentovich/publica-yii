<?php

use yii\db\Schema;
use console\migrations\Migration;

class m170523_000354_post extends Migration
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
            '{{%post}}',
            [
                'id'=> $this->primaryKey(10),
                'user_id'=> $this->integer(10)->notNull(),
                'city_id'=> $this->integer(10)->notNull(),
                'event_at'=> $this->date()->null()->defaultValue(null)->comment('Дата события. Для поиска timestump. Триггер для приведения к нужному виду. Индекс'),
                'post_category_id'=> $this->integer(10)->notNull()->defaultValue(1)->comment('Родительская категория. не fkey'),
                'image_id'=> $this->integer(10)->null()->defaultValue(1)->comment('Главное изображение. Ссылка на ресурс.'),
                'status'=> $this->smallInteger(1)->notNull()->defaultValue(0)->comment('0 - на модерации 1 - одобрено 2 - отклонено 3 - заблокировано 4 - удален'),
                'created_at'=> $this->timestamp()->notNull()->defaultExpression("CURRENT_TIMESTAMP")->comment('Дата создания. Для вывода на страницу постов. Задается триггером'),

            ],$this->tableOptions
        );
        $this->createIndex('event_at','{{%post}}',['event_at'],false);
        $this->createIndex('category_id','{{%post}}',['post_category_id'],false);
        $this->createIndex('fk_tbl_post_user_id','{{%post}}',['user_id'],false);
        $this->createIndex('image_id','{{%post}}',['image_id'],false);
        $this->createIndex('user_id','{{%post}}',['user_id'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('event_at', '{{%post}}');
        $this->dropIndex('category_id', '{{%post}}');
        $this->dropIndex('fk_tbl_post_user_id', '{{%post}}');
        $this->dropIndex('image_id', '{{%post}}');
        $this->dropIndex('user_id', '{{%post}}');
        $this->dropTable('{{%post}}');
    }
}
