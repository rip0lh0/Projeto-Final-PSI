<?php

use yii\db\Migration;

class m181114_201755_create_table_ficha_medica extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ficha_medica}}', [
            'id' => $this->primaryKey(),
            'id_animal' => $this->integer()->notNull(),
            'chip' => $this->tinyInteger()->notNull(),
            'genero' => $this->char()->notNull(),
            'tamanho' => $this->float(),
            'idate' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('fkIdx_216', '{{%ficha_medica}}', 'id_animal');
    }

    public function down()
    {
        $this->dropTable('{{%ficha_medica}}');
    }
}
