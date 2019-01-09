<?php

use yii\db\Migration;

/**
 * Class m190108_181405_update_data
 */
class m190108_181405_update_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->renameColumn('kennel_animal', 'state', 'status');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        echo "m190108_181405_update_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190108_181405_update_data cannot be reverted.\n";

        return false;
    }
     */
}
