<?php

use yii\db\Migration;

/**
 * Class m180626_135355_cart_item
 */
class m180626_135355_cart_item extends Migration
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
        echo "m180626_135355_cart_item cannot be reverted.\n";

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

        $this->createTable('{{%cart_item}}', [
            'id' => $this->primaryKey(),
            'productid' => $this->integer()->notNull()->unique(),
            'cartid' => $this->integer()->notNull()->unique(),
            'quantity' => $this->integer()->notNull(),
            'subTotal' => $this->integer()->notNull(),

        ], $tableOptions);
        $this->addForeignKey('fk_cartitem_cart','cart_item','cartid','cart','id');
        $this->addForeignKey('fk_cartitem_product','cart_item','productid','product','id');
    }

    public function down()
    {
        echo "m180626_135355_cart_item cannot be reverted.\n";

        return false;
    }
    
}
