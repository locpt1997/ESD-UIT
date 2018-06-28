<?php

use yii\db\Migration;

/**
 * Class m180626_132238_cart
 */
class m180626_132238_cart extends Migration
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
        echo "m180626_132238_cart cannot be reverted.\n";

        return false;
    }


    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%cart}}', [
            'id' => $this->primaryKey(),
            'customerid' => $this->integer()->notNull()->unique(),
            'totalPrice' => $this->integer(),
            
        ], $tableOptions);
        $this->addForeignKey('fk_cart_customer', 'cart', 'customerid', 'customer', 'id');
    }

    public function down()
    {
        echo "m180626_132238_cart cannot be reverted.\n";

        return false;
    }
    
}
