<?php

use yii\db\Migration;

class m181110_195130_create_table_perfil extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%perfil}}', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer()->notNull(),
            'id_tipo' => $this->integer()->notNull(),
            'nif' => $this->double()->notNull(),
            'nome' => $this->string()->notNull(),
            'morada' => $this->string(),
            'localidade' => $this->string(),
            'nacionalidade' => $this->string(),
            'contacto' => $this->double()->notNull(),
        ], $tableOptions);

        $this->createIndex('fkIdx_90', '{{%perfil}}', 'id_tipo');
        $this->createIndex('fkIdx_46', '{{%perfil}}', 'id_user');
    }

    public function down()
    {
        $this->dropTable('{{%perfil}}');
    }
}
