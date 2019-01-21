<?php

use yii\db\Migration;

/**
 * Class m190121_190213_drop_id
 */
class m190121_190213_drop_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->dropColumn('schedule', 'id');
        //$this->dropPrimaryKey('id', 'schedule');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190121_190213_drop_id cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190121_190213_drop_id cannot be reverted.\n";

        return false;
    }
     */
}
