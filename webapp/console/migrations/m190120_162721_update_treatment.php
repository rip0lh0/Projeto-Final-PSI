<?php

use yii\db\Migration;

/**
 * Class m190120_162721_update_treatment
 */
class m190120_162721_update_treatment extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('treatment', 'name', $this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190120_162721_update_treatment cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190120_162721_update_treatment cannot be reverted.\n";

        return false;
    }
     */
}
