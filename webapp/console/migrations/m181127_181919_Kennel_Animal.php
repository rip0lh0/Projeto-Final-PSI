<?php

use yii\db\Migration;

/**
 * Class m181127_181919_Kennel_Animal
 */
class m181127_181919_Kennel_Animal extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%kennel_animal}}', [
            'id' => $this->primaryKey(),
            'id_kennel' => $this->integer()->notNull(),
            'id_animal' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
            'state' => $this->tinyInteger(),
        ], $tableOptions);

        $this->createIndex(
            'idx-kennel_animal-id_kennel',
            '{{%kennel_animal}}',
            'id_kennel'
        );

        $this->addForeignKey(
            'fk-kennel_animal-id_kennel',
            '{{%kennel_animal}}',
            'id_kennel',
            '{{%kennel}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-kennel_animal-id_animal',
            '{{%kennel_animal}}',
            'id_animal'
        );

        $this->addForeignKey(
            'fk-kennel_animal-id_animal',
            '{{%kennel_animal}}',
            'id_animal',
            '{{%animal}}',
            'id',
            'CASCADE'
        );

    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-kennel_animal-id_kennel',
            '{{%kennel_animal}}'
        );

        $this->dropIndex(
            'idx-kennel_animal-id_kennel',
            '{{%kennel_animal}}'
        );

        $this->dropForeignKey(
            'fk-kennel_animal-id_animal',
            '{{%kennel_animal}}'
        );

        $this->dropIndex(
            'idx-kennel_animal-id_animal',
            '{{%kennel_animal}}'
        );
        $this->dropTable('{{%kennel_animal}}');
    }
}
