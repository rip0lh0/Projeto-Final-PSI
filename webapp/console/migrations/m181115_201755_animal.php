<?php

use yii\db\Migration;

class m181115_201755_animal extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%animal}}', [
            'id' => $this->primaryKey(),
            'id_ficha' => $this->integer()->notNull(),
            'id_tipo' => $this->integer()->notNull(),
            'nome' => $this->string(),
            'descricao' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-animal-id_ficha',
            '{{%animal}}',
            'id_ficha'
        );

        $this->addForeignKey(
            'fk-animal-id_ficha',
            '{{%animal}}',
            'id_ficha',
            '{{%ficha}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-animal-id_tipo',
            '{{%animal}}',
            'id_tipo'
        );

        $this->addForeignKey(
            'fk-animal-id_tipo',
            '{{%animal}}',
            'id_tipo',
            '{{%type_animal}}',
            'id',
            'CASCADE'
        );

    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-animal-id_ficha',
            '{{%animal}}'
        );

        $this->dropIndex(
            'idx-animal-id_ficha',
            '{{%animal}}'
        );

        $this->dropForeignKey(
            'fk-animal-id_tipo',
            '{{%animal}}'
        );

        $this->dropIndex(
            'idx-animal-id_tipo',
            '{{%animal}}'
        );

        $this->dropTable('{{%animal}}');
    }
}
