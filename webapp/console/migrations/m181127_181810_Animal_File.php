<?php

use yii\db\Migration;

/**
 * Class m181127_181810_Animal_File
 */
class m181127_181810_Animal_File extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%animal_file}}', [
            'id' => $this->primaryKey(),
            'id_animal' => $this->integer()->notNull(),
            'id_breed' => $this->integer(),
            'chip' => $this->string()->unique(),
            'neutered' => $this->tinyInteger()->notNull(),
            'gender' => $this->char()->notNull(),
            'weight' => $this->float(),
            'age' => $this->integer(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-animal_file-id_animal',
            '{{%animal_file}}',
            'id_animal'
        );

        $this->addForeignKey(
            'fk-animal_file-id_animal',
            '{{%animal_file}}',
            'id_animal',
            '{{%animal}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-animal_file-id_breed',
            '{{%animal_file}}',
            'id_breed'
        );

        $this->addForeignKey(
            'fk-animal_file-id_breed',
            '{{%animal_file}}',
            'id_breed',
            '{{%breed}}',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-animal_file-id_animal',
            '{{%animal_file}}'
        );

        $this->dropIndex(
            'idx-animal_file-id_animal',
            '{{%animal_file}}'
        );

        $this->dropForeignKey(
            'fk-animal_file-id_breed',
            '{{%animal_file}}'
        );

        $this->dropIndex(
            'idx-animal_file-id_breed',
            '{{%animal_file}}'
        );

        $this->dropTable('{{%animal}}');
    }
}
