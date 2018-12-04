<?php

use yii\db\Migration;

/**
 * Class m181203_235227_File_Breed
 */
class m181203_235227_File_Breed extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%file_breed}}', [
            'id_file' => $this->integer()->notNull(),
            'id_breed' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-file_breed-id_file',
            '{{%file_breed}}',
            'id_file'
        );

        $this->addForeignKey(
            'fk-file_breed-id_file',
            '{{%file_breed}}',
            'id_file',
            '{{%animal_file}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-file_breed-id_breed',
            '{{%file_breed}}',
            'id_breed'
        );

        $this->addForeignKey(
            'fk-file_breed-id_breed',
            '{{%file_breed}}',
            'id_breed',
            '{{%breed}}',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-file_breed-id_breed',
            '{{%file_breed}}'
        );

        $this->dropIndex(
            'idx-file_breed-id_breed',
            '{{%file_breed}}'
        );

        $this->dropForeignKey(
            'fk-file_breed-id_file',
            '{{%file_breed}}'
        );

        $this->dropIndex(
            'idx-file_breed-id_file',
            '{{%file_breed}}'
        );

        $this->dropTable('{{%file_breed}}');
    }
}
