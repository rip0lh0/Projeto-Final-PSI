<?php

use yii\db\Migration;

class m181115_201753_raca extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%raca}}', [
            'id' => $this->primaryKey(),
            'nome' => $this->string()->notNull(),
            'tipo' => $this->string()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%raca}}');
    }
}
