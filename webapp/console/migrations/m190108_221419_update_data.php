<?php

use yii\db\Migration;

/**
 * Class m190108_221419_update_data
 */
class m190108_221419_update_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createIndex(
            'idx-animal-id_energy',
            '{{%animal}}',
            'id_energy'
        );

        $this->addForeignKey(
            'fk-animal-id_energy',
            '{{%animal}}',
            'id_energy',
            '{{%energy}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-animal-id_coat',
            '{{%animal}}',
            'id_coat'
        );

        $this->addForeignKey(
            'fk-animal-id_coat',
            '{{%animal}}',
            'id_coat',
            '{{%coat}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-animal-id_size',
            '{{%animal}}',
            'id_size'
        );

        $this->addForeignKey(
            'fk-animal-id_size',
            '{{%animal}}',
            'id_size',
            '{{%size}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        echo "m190108_221419_update_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190108_221419_update_data cannot be reverted.\n";

        return false;
    }
     */
}
