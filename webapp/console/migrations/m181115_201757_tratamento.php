<?php

use yii\db\Migration;

class m181115_201757_tratamento extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tratamento}}', [
            'id' => $this->primaryKey(),
            'id_ficha' => $this->integer()->notNull(),
            'duracao' => $this->integer()->notNull(),
            'descricao' => $this->string(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
            'estado' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-tratamento-id_ficha',
            '{{%tratamento}}',
            'id_ficha'
        );

        $this->addForeignKey(
            'fk-tratamento-id_ficha',
            '{{%tratamento}}',
            'id_ficha',
            '{{%ficha}}',
            'id',
            'CASCADE'
        );

    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-tratamento-id_ficha',
            '{{%tratamento}}'
        );

        $this->dropIndex(
            'idx-tratamento-id_ficha',
            '{{%tratamento}}'
        );

        $this->dropTable('{{%tratamento}}');
    }
}
