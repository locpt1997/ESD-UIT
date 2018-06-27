<?php

use yii\db\Migration;

/**
 * Class m180626_075757_customer
 */
class m180626_075757_customer extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180626_075757_customer cannot be reverted.\n";

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
        $this->createTable('{{%customer}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull()->unique(),
            'name' => $this->string()->notNull(),
            'gender' => $this->boolean(),
            'birthday' => $this->date(),
            'email' => $this->string()->unique(),
            'contact_number' => $this->string(),
            'address' => $this->string(),
            'location_name' => $this->string(),
    
        ], $tableOptions);
    }

    public function down()
    {
        echo "m180626_075757_customer cannot be reverted.\n";
        return false;
    }
}

