<?php

use yii\db\Migration;

/**
 * Class m190108_023446_update_dates
 */
class m190108_023446_update_dates extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->alterColumn('animal', 'created_at', $this->timestamp()->notNull());
        $this->alterColumn('animal', 'updated_at', $this->timestamp()->notNull());

        $this->alterColumn('adoption', 'created_at', $this->timestamp()->notNull());
        $this->alterColumn('adoption', 'updated_at', $this->timestamp()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        echo "m190108_023446_update_dates cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190108_023446_update_dates cannot be reverted.\n";

        return false;
    }
     */
}
