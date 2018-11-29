<?php

use yii\db\Migration;

/**
 * Class m181129_094159_breed_energy
 */
class m181129_094159_Breed_Energy extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%breed_energy}}', [
            'id_energy' => $this->integer()->notNull(),
            'id_breed' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-breed_energy-id_energy',
            '{{%breed_energy}}',
            'id_energy'
        );

        $this->addForeignKey(
            'fk-breed_energy-id_energy',
            '{{%breed_energy}}',
            'id_energy',
            '{{%energy}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-breed_energy-id_breed',
            '{{%breed_energy}}',
            'id_breed'
        );

        $this->addForeignKey(
            'fk-breed_energy-id_breed',
            '{{%breed_energy}}',
            'id_breed',
            '{{%breed}}',
            'id',
            'CASCADE'
        );

    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-breed_energy-id_breed',
            '{{%breed_energy}}'
        );

        $this->dropIndex(
            'idx-breed_energy-id_breed',
            '{{%breed_energy}}'
        );

        $this->dropForeignKey(
            'fk-breed_energy-id_energy',
            '{{%breed_energy}}'
        );

        $this->dropIndex(
            'idx-breed_energy-id_energy',
            '{{%breed_energy}}'
        );

        $this->dropTable('{{%breed_energy}}');
    }
}
