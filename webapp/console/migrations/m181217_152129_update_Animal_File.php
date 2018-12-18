<?php

use yii\db\Migration;

/**
 * Class m181217_152129_update_Animal_File
 */
class m181217_152129_update_Animal_File extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('breed_coat');
        $this->dropTable('breed_energy');
        $this->dropTable('breed_size');

        $this->addColumn('animal_file', 'id_coat', $this->integer());
        $this->addColumn('animal_file', 'id_energy', $this->integer());
        $this->addColumn('animal_file', 'id_size', $this->integer());

        $this->createIndex(
            'idx-animal_file-id_coat',
            'animal_file',
            'id_coat'
        );

        $this->addForeignKey(
            'fk-animal_file-id_coat',
            'animal_file',
            'id_coat',
            'coat',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-animal_file-id_energy',
            'animal_file',
            'id_energy'
        );

        $this->addForeignKey(
            'fk-animal_file-id_energy',
            'animal_file',
            'id_energy',
            'energy',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-animal_file-id_size',
            'animal_file',
            'id_size'
        );

        $this->addForeignKey(
            'fk-animal_file-id_size',
            'animal_file',
            'id_size',
            'size',
            'id',
            'CASCADE'
        );


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181217_152129_update_Animal_File cannot be reverted.\n";

        return false;
    }
     */
}
