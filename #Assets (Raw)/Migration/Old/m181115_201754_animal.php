<?php

use yii\db\Migration;

class m181115_201754_animal extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%animal}}', [
            'id' => $this->primaryKey(),
            'nome' => $this->string(),
            'descricao' => $this->string(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%animal}}');
    }
}
