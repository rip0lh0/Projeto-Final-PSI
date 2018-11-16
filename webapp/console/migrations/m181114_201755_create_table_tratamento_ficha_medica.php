<?php

use yii\db\Migration;

class m181114_201755_create_table_tratamento_ficha_medica extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tratamento_ficha_medica}}', [
            'id_tratamento' => $this->integer()->notNull(),
            'id_ficha_medica' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('fkIdx_199', '{{%tratamento_ficha_medica}}', 'id_tratamento');
        $this->createIndex('fkIdx_206', '{{%tratamento_ficha_medica}}', 'id_ficha_medica');
    }

    public function down()
    {
        $this->dropTable('{{%tratamento_ficha_medica}}');
    }
}
