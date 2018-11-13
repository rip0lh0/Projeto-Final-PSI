<?php

use yii\db\Migration;

class m181110_195130_create_table_dados_veterinarios extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%dados_veterinarios}}', [
            'id' => $this->primaryKey(),
            'vacinacao' => $this->string()->notNull(),
            'doencas' => $this->string()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%dados_veterinarios}}');
    }
}
