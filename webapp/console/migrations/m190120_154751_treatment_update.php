<?php

use yii\db\Migration;

/**
 * Class m190120_154751_treatment_update
 */
class m190120_154751_treatment_update extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        // $this->addColumn('treatment', 'id_animal', $this->integer()->notNull());

        // $this->createIndex(
        //     'idx-treatment-id_animal',
        //     '{{%treatment}}',
        //     'id_animal'
        // );

        // $this->addForeignKey(
        //     'fk-treatment-id_animal',
        //     '{{%treatment}}',
        //     'id_animal',
        //     '{{%animal}}',
        //     'id',
        //     'CASCADE'
        // );

    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        echo "m190120_154751_treatment_update cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190120_154751_treatment_update cannot be reverted.\n";

        return false;
    }
     */
}
