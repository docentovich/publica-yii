<?php

namespace orders\migrations;

use yii\db\Migration;

/**
 * Class m190111_141020_link_planner_and_orders
 */
class m190111_141020_link_planner_and_orders extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            '{{%date_time_planner}}',
            'order_id',
            $this->integer(10)->defaultValue(null)
        );

        $this->createIndex('order_id', '{{%date_time_planner}}', ['order_id']);
        $this->createIndex('unique_date_time_user_id_order_id','{{%date_time_planner}}', ['order_id', 'date', 'time', 'user_id'],true);


        $this->addForeignKey('fk_date_time_planner_order_id',
            '{{%date_time_planner}}', 'order_id',
            '{{%orders}}', 'id',
            'CASCADE', 'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_date_time_planner_order_id', '{{%date_time_planner}}');
        $this->dropIndex('order_id', '{{%date_time_planner}}');
        $this->dropIndex('unique_date_time_user_id_order_id', '{{%date_time_planner}}');
        $this->dropColumn('{{%date_time_planner}}', 'order_id');
    }

}
