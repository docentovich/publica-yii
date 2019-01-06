<?php

namespace tosee\migrations;

class m190103_005549_tosee_post extends \yii\db\Migration
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
            '{{%tosee_post}}',
            [
                'id'=> $this->primaryKey(10),
                'user_id'=> $this->integer(10)->null()->defaultValue(null),
                'city_id'=> $this->integer(10)->null()->defaultValue(null),
                'event_at'=> $this->date()->null()->defaultValue(null)->comment('Дата события. Для поиска timestump. Триггер для приведения к нужному виду. Индекс'),
                'post_category_id'=> $this->integer(10)->notNull()->defaultValue(1)->comment('Родительская категория. не fkey'),
                'image_id'=> $this->integer(10)->null()->defaultValue(null)->comment('Главное изображение. Ссылка на ресурс.'),
                'status'=> $this->smallInteger(1)->notNull()->defaultValue(3)->comment('0 - на модерации 1 - отклонено 2 - заблокировано 3 - активно 4 - удален'),
                'created_at'=> $this->timestamp()->notNull()->defaultExpression("CURRENT_TIMESTAMP")->comment('Дата создания. Для вывода на страницу постов. Задается триггером'),
            ],$tableOptions
        );
        $this->createIndex('event_at','{{%tosee_post}}',['event_at'],false);
        $this->createIndex('category_id','{{%tosee_post}}',['post_category_id'],false);
        $this->createIndex('fk_tbl_post_user_id','{{%tosee_post}}',['user_id'],false);
        $this->createIndex('image_id','{{%tosee_post}}',['image_id'],false);
        $this->createIndex('city_id','{{%tosee_post}}',['city_id'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('event_at', '{{%tosee_post}}');
        $this->dropIndex('category_id', '{{%tosee_post}}');
        $this->dropIndex('fk_tbl_post_user_id', '{{%tosee_post}}');
        $this->dropIndex('image_id', '{{%tosee_post}}');
        $this->dropIndex('city_id', '{{%tosee_post}}');
        $this->dropTable('{{%tosee_post}}');
    }
}
