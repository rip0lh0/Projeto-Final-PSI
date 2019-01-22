<?php

use yii\db\Migration;

/**
 * Class m190121_234637_fix_timestamp
 */
class m190121_234637_fix_timestamp extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->alterColumn('adoption', 'created_at', $this->integer()->notNull());
        $this->alterColumn('adoption', 'updated_at', $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190121_234637_fix_timestamp cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190121_234637_fix_timestamp cannot be reverted.\n";

        return false;
    }
    */
}
