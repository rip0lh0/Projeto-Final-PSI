<?php

use yii\db\Migration;

class m181114_201757_create_table_tratamento extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tratamento}}', [
            'id' => $this->primaryKey(),
            'id_ficha_medica' => $this->integer()->notNull(),
            'created_at' => $this->date()->notNull(),
            'duracao' => $this->integer()->notNull(),
            'descricao' => $this->string(),
            'estado' => $this->string(),
        ], $tableOptions);

        $this->createIndex(
            'idx-tratamento-id_ficha_medica',
            '{{%tratamento}}',
            'id_ficha_medica'
        );

        $this->addForeignKey(
            'fk-tratamento-id_ficha_medica',
            '{{%tratamento}}',
            'id_ficha_medica',
            '{{%ficha_medica}}',
            'id',
            'CASCADE'
        );

    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-tratamento-id_ficha_medica',
            '{{%tratamento}}'
        );

        $this->dropIndex(
            'idx-tratamento-id_ficha_medica',
            '{{%tratamento}}'
        );

        $this->dropTable('{{%tratamento}}');
    }
}
