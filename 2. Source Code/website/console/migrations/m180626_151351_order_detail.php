<?php

use yii\db\Migration;

/**
 * Class m180626_151351_order_detail
 */
class m180626_151351_order_detail extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180626_151351_order_detail cannot be reverted.\n";

        return false;
    }

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%order_detail}}', [
            'id' => $this->primaryKey(),
            'productid' => $this->integer()->notNull()->unique(),
            'price' => $this->integer()->notNull(),
            'discount' => $this->integer(),
            'discounrRatio' => $this->float(),

        ], $tableOptions);
        $this->addForeignKey('fk_orderdetail_product','order_detail','productid','product','id');
    }

    public function down()
    {
        echo "m180626_151351_order_detail cannot be reverted.\n";

        return false;
    }
    
}
