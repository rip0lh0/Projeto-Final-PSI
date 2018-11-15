<?php

use yii\db\Migration;

class m181114_201755_create_table_tratamento extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tratamento}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->date()->notNull(),
            'duracao' => $this->integer()->notNull(),
            'descricao' => $this->string()->notNull(),
            'estado' => $this->string()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%tratamento}}');
    }
}
