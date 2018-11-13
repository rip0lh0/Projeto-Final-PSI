<?php

use yii\db\Migration;

class m181110_195130_create_table_animal extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%animal}}', [
            'id' => $this->primaryKey(),
            'id_dados_veterinarios' => $this->integer()->notNull(),
            'id_raca' => $this->integer()->notNull(),
            'chip' => $this->tinyInteger()->notNull(),
            'nome' => $this->string()->notNull(),
            'genero' => $this->char()->notNull(),
            'tamanho' => $this->float()->notNull(),
            'idade' => $this->integer()->notNull(),
            'descricao' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createIndex('fkIdx_87', '{{%animal}}', 'id_raca');
        $this->createIndex('fkIdx_69', '{{%animal}}', 'id_dados_veterinarios');
    }

    public function down()
    {
        $this->dropTable('{{%animal}}');
    }
}
