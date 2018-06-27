<?php

use yii\db\Migration;

/**
 * Class m180626_151656_order
 */
class m180626_151656_order extends Migration
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
        echo "m180626_151656_order cannot be reverted.\n";

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

        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'customerid' => $this->integer()->notNull()->unique(),
            'purchaseDate' => $this->datetime(),
            'status' => $this->integer(),
            'description' => $this->string(),
            'total' => $this->integer(),
            'usingCod' => $this->boolean(), 
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->addForeignKey('fk_order_product','order','customerid','customer','id');
    }

    public function down()
    {
        echo "m180626_151656_order cannot be reverted.\n";

        return false;
    }
    
}
