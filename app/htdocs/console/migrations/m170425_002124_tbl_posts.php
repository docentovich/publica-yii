<?php

use yii\db\Schema;
use yii\db\Migration;

class m170425_002124_tbl_posts extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB  CHARSET=utf8';
		
		//post_category_id Не делал внешним ключом так как category MyISAM. Это выгоднее. Категории не меняються особо
        $this->createTable('{{%post}}',[
            'id'=> $this->primaryKey(10),
			'user_id'=> $this->integer(10)->notNull(),
            'event_at'=> $this->integer(16)->null()->defaultValue(null)->comment('Дата события. Для поиска timestump. Триггер для приведения к нужному виду. Индекс'),
            'post_category_id'=> $this->integer(10)->notNull()->defaultValue(1)->comment('Родительская категория. не fkey'),
            'status'=> $this->smallInteger(1)->notNull()->defaultValue(0)->comment('0 - на модерации 1 - одобрено 2 - отклонено 3 - заблокировано 4 - удален'),
            'created_at'=> $this->integer(8)->notNull()->comment('Дата создания. Для вывода на страницу постов. Задается триггером'),
            'main_image'=> $this->char(32)->null()->defaultValue(null)->comment('Главное изображение. Тут только название изображения (md5). Полный путь user_name/{md5}.jpg'),
        ], $tableOptions);

        $this->createIndex('event_at','{{%post}}',['event_at'],false);
        $this->createIndex('category_id','{{%post}}',['post_category_id'],false);

        $this->createTable('{{%postData}}',[
            'post_id'=> $this->primaryKey(10)->comment('fkey'),
            'title'=> $this->string(255)->notNull(),
            'sub_header'=> $this->text()->notNull()->comment('Подзаголовок'),
            'post_short_desc'=> $this->string(255)->null()->defaultValue(null),
            'post_desc'=> $this->text()->null()->defaultValue(null),
            'post_like_count'=> $this->integer(10)->notNull()->defaultValue(0),
            'post_view_count'=> $this->integer(15)->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->addForeignKey(
            'fk_tbl_postData_post_id',
            '{{%postData}}', 'post_id',
            '{{%post}}', 'id',
            'CASCADE', 'CASCADE'
        );
		
		$this->addForeignKey(
            'fk_tbl_post_user_id',
            '{{%post}}', 'user_id',
            '{{%user}}', 'id',
            'CASCADE', 'CASCADE'
        );
    }

    public function safeDown()
    {
            $this->dropForeignKey('fk_tbl_postData_post_id', '{{%postData}}');
            $this->dropTable('{{%post}}');
            $this->dropTable('{{%postData}}');
    }
}
