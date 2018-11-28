<?php

use yii\db\Migration;

/**
 * Class m181127_181820_Treatment
 */
class m181127_181820_Treatment extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%treatment}}', [
            'id' => $this->primaryKey(),
            'id_animal_file' => $this->integer()->notNull(),
            'description' => $this->string(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull()
        ], $tableOptions);

        $this->createIndex(
            'idx-treatment-id_animal_file',
            '{{%treatment}}',
            'id_animal_file'
        );

        $this->addForeignKey(
            'fk-treatment-id_animal_file',
            '{{%treatment}}',
            'id_animal_file',
            '{{%animal_file}}',
            'id',
            'CASCADE'
        );

    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-animal_file-id_animal_file',
            '{{%treatment}}'
        );

        $this->dropIndex(
            'idx-animal_file-id_animal_file',
            '{{%treatment}}'
        );

        $this->dropTable('{{%treatment}}');
    }
}
