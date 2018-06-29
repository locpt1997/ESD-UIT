<?php

use yii\db\Migration;

/**
 * Class m180629_080833_admin
 */
class m180629_080833_admin extends Migration
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
        echo "m180629_080833_admin cannot be reverted.\n";

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
        $this->createTable('{{%admin}}', [
            'id' => $this->primaryKey(),
            'client_id' => $this->string(),
            'client_secret' => $this->string(),
            'access_token' => $this->string(),
            'userid' => $this->integer(),
        ], $tableOptions);
        $this->addForeignKey('fk_admin_user', 'admin', 'userid', 'user', 'id');

    }

    public function down()
    {
        echo "m180629_080833_admin cannot be reverted.\n";

        return false;
    }
    
}
