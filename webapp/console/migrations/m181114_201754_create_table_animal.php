<?php

use yii\db\Migration;

class m181114_201754_create_table_animal extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%animal}}', [
            'id' => $this->primaryKey(),
            'id_raca' => $this->integer()->notNull(),
            'nome' => $this->string()->notNull(),
            'descricao' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createIndex('fkIdx_87', '{{%animal}}', 'id_raca');
    }

    public function down()
    {
        $this->dropTable('{{%animal}}');
    }
}
