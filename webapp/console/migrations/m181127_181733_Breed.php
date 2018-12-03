<?php

use yii\db\Migration;

/**
 * Class m181127_181733_Breed
 */
class m181127_181733_Breed extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%breed}}', [
            'id' => $this->primaryKey(),
            'id_parent' => $this->integer(),
            'name' => $this->string()->notNull(),
            'description' => $this->string(),
            'origin' => $this->string(),
            'lifespan' => $this->string(),
        ], $tableOptions);

        $this->createIndex(
            'idx-breed-id_parent',
            '{{%breed}}',
            'id_parent'
        );

        $this->addForeignKey(
            'fk-breed-id_parent',
            '{{%breed}}',
            'id_parent',
            '{{%breed}}',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-breed-id_parent',
            '{{%breed}}'
        );

        $this->dropIndex(
            'idx-breed-id_parent',
            '{{%breed}}'
        );

        $this->dropTable('{{%breed}}');
    }
}
