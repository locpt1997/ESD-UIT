<?php

use yii\db\Migration;

/**
 * Class m180626_135334_product
 */
class m180626_135334_product extends Migration
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
        echo "m180626_135334_product cannot be reverted.\n";

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

        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'description' => $this->text(),
            'basePrice' => $this->decimal(),
            'weight' => $this->float(),
            'image' => $this->string(),
            'categoryid' => $this->integer()->notNull(),
            'onHand' => $this->integer()->notNull(),
  
        ], $tableOptions);
        $this->addForeignKey('fk_product_category','product','categoryid','category','id');
    }

    public function down()
    {
        echo "m180626_135334_product cannot be reverted.\n";

        return false;
    }
    
}
