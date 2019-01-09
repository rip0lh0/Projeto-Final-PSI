<?php

use yii\db\Migration;

/**
 * Class m190108_174604_update_data
 */
class m190108_174604_update_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        //$this->dropPrimaryKey('kennel_animal');

        $this->dropColumn('animal', 'created_at');
        $this->dropColumn('animal', 'updated_at');
        $this->dropColumn('animal', 'status');

        $this->alterColumn('kennel_animal', 'created_at', $this->integer()->notNull());
        $this->alterColumn('kennel_animal', 'updated_at', $this->integer()->notNull());

    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        echo "m190108_174604_update_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190108_174604_update_data cannot be reverted.\n";

        return false;
    }
     */
}
