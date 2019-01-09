<?php

use yii\db\Migration;

/**
 * Class m190108_153558_update_data
 */
class m190108_153558_update_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createIndex(
            'idx-kennel-id_local',
            '{{%kennel}}',
            'id_local'
        );

        $this->addForeignKey(
            'fk-kennel-id_local',
            '{{%kennel}}',
            'id_local',
            '{{%local}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        echo "m190108_153558_update_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190108_153558_update_data cannot be reverted.\n";

        return false;
    }
     */
}
