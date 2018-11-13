<?php

use yii\db\Migration;

class m181110_195130_create_table_tipo_perfil extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tipo_perfil}}', [
            'id' => $this->primaryKey(),
            'descricao' => $this->string()->notNull(),
        ], $tableOptions);

        $this->insert('{{%tipo_perfil}}', [
            'descricao' => 'Canil'
        ]);
        $this->insert('{{%tipo_perfil}}', [
            'descricao' => 'Adotante'
        ]);

    }

    public function down()
    {
        $this->dropTable('{{%tipo_perfil}}');
    }
}
