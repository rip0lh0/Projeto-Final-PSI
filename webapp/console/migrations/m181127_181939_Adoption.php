<?php

use yii\db\Migration;

/**
 * Class m181127_181939_Adoption
 */
class m181127_181939_Adoption extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%adoption}}', [
            'id' => $this->primaryKey(),
            'id_adopter' => $this->integer()->notNull(),
            'id_animal' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
            'description' => $this->string(),
            'state' => $this->integer(),
        ], $tableOptions);

        $this->createIndex(
            'idx-adoption-id_adopter',
            '{{%adoption}}',
            'id_adopter'
        );

        $this->addForeignKey(
            'fk-adoption-id_adopter',
            '{{%adoption}}',
            'id_adopter',
            '{{%adopter}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-adoption-id_animal',
            '{{%adoption}}',
            'id_animal'
        );

        $this->addForeignKey(
            'fk-adoption-id_animal',
            '{{%adoption}}',
            'id_animal',
            '{{%kennel_animal}}',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-adoption-id_animal',
            '{{%adoption}}'
        );

        $this->dropIndex(
            'idx-adoption-id_animal',
            '{{%adoption}}'
        );

        $this->dropTable('{{%adoption}}');
    }
}
