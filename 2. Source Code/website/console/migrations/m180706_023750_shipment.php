<?php

use yii\db\Migration;

/**
 * Class m180706_023750_shipment
 */
class m180706_023750_shipment extends Migration
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
        echo "m180706_023750_shipment cannot be reverted.\n";

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

        $this->createTable('{{%shipment}}', [
            'id' => $this->primaryKey(),
            'deliveryCode' => $this->string(),
            'shippingType' => $this->string(),
            'shippingCost' => $this->integer(),
            'shippingAddress' => $this->string(),
            'orderId' => $this->integer(),
        ], $tableOptions);
        $this->addForeignKey('fk_shipment_order','shipment','orderId','order','id');

    }

    public function down()
    {
        echo "m180706_023750_shipment cannot be reverted.\n";

        return false;
    }
    
}
