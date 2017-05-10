<?php

use yii\db\Schema;
use yii\db\Migration;

class m170425_001718_tbl_users extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB  CHARSET=utf8';

        $this->createTable('{{%user}}',[
            'id'=> $this->primaryKey(10),
            'username'=> $this->string(100)->notNull()->comment('Уникальное'),
            'user_group_id'=> $this->integer(10)->notNull()->defaultValue(1)->comment('Индекс. fkey'),
            'first_name'=> $this->string(100)->null()->defaultValue(null),
            'last_name'=> $this->string(100)->null()->defaultValue(null),
			
            'password_hash'=> $this->char(32)->notNull(),
            'auth_key'=> $this->string(32)->null()->defaultValue(null),
			'password_reset_token' => $this->string()->unique()->defaultValue(null),
			
            'email'=> $this->string(50)->notNull(),
            'phone'=> $this->integer(12)->null()->defaultValue(null),
            'avatar'=> $this->char(32)->null()->defaultValue(null),
			
            'respond_sms'=> $this->smallInteger(1)->notNull()->defaultValue(0),
            'respond_email'=> $this->smallInteger(1)->notNull()->defaultValue(1),
			
			'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('username','{{%user}}',['username'],true);
        $this->createIndex('group_id','{{%user}}',['user_group_id'],false);

        $this->createTable('{{%userAbout}}',[
            'user_id'=> $this->primaryKey(10),
            'about'=> $this->text()->notNull(),
        ], $tableOptions);


        $this->createTable('{{%userGroup}}',[
            'id'=> $this->primaryKey(10),
            'name'=> $this->char(30)->notNull(),
        ], $tableOptions);


        $this->createTable('{{%userLike}}',[
            'user_id'=> $this->integer(10)->notNull(),
            'model'=> $this->char(10)->notNull()->comment('Ссылка на модель'),
            'item_id'=> $this->integer(10)->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('pk_on_tbl_userLike','{{%userLike}}',['user_id','model','item_id']);
		
        $this->addForeignKey(
            'fk_tbl_user_userGroup_id',
            '{{%user}}', 'user_group_id',
            '{{%userGroup}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_tbl_userAbout_user_id',
            '{{%userAbout}}', 'user_id',
            '{{%user}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_tbl_userLike_user_id',
            '{{%userLike}}', 'user_id',
            '{{%user}}', 'id',
            'CASCADE', 'CASCADE'
        );
    }

    public function safeDown()
    {
            $this->dropForeignKey('fk_tbl_user_userGroup_id', '{{%user}}');
            $this->dropForeignKey('fk_tbl_userAbout_user_id', '{{%userAbout}}');
            $this->dropForeignKey('fk_tbl_userLike_user_id', '{{%userLike}}');
            $this->dropTable('{{%user}}');
            $this->dropTable('{{%userAbout}}');
            $this->dropTable('{{%userGroup}}');
            $this->dropPrimaryKey('pk_on_tbl_userLike','{{%userLike}}');
            $this->dropTable('{{%userLike}}');
    }
}
