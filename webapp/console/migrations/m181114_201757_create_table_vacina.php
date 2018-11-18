<?php

use yii\db\Migration;

class m181114_201757_create_table_vacina extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%vacina}}', [
            'id' => $this->primaryKey(),
            'id_tratamento' => $this->integer()->notNull(),
            'vacina' => $this->string()->notNull(),
            'data' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-vacina-id_tratamento',
            '{{%vacina}}',
            'id_tratamento'
        );

        $this->addForeignKey(
            'fk-vacina-id_tratamento',
            '{{%vacina}}',
            'id_tratamento',
            '{{%tratamento}}',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-vacina-id_tratamento',
            '{{%vacina}}'
        );

        $this->dropIndex(
            'idx-vacina-id_tratamento',
            '{{%vacina}}'
        );
        $this->dropTable('{{%vacina}}');
    }
}
