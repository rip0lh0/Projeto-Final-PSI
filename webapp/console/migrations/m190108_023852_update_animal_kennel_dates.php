<?php

use yii\db\Migration;

/**
 * Class m190108_023852_update_animal_kennel_dates
 */
class m190108_023852_update_animal_kennel_dates extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->alterColumn('kennel_animal', 'created_at', $this->timestamp()->notNull());
        $this->alterColumn('kennel_animal', 'updated_at', $this->timestamp()->notNull());

    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190108_023852_update_animal_kennel_dates cannot be reverted.\n";

        return false;
    }
     */
}
