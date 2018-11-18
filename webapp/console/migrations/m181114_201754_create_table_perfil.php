<?php

use yii\db\Migration;

class m181114_201754_create_table_perfil extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%perfil}}', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer()->notNull(),
            'nif' => $this->double()->notNull(),
            'nome' => $this->string()->notNull(),
            'morada' => $this->string(),
            'localidade' => $this->string(),
            'nacionalidade' => $this->string(),
            'contacto' => $this->double()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-perfil-id_user',
            '{{%perfil}}',
            'id_user'
        );

        $this->addForeignKey(
            'fk-perfil-id_user',
            '{{%perfil}}',
            'id_user',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-perfil-id_user',
            '{{%perfil}}'
        );

        $this->dropIndex(
            'idx-perfil-id_user',
            '{{%perfil}}'
        );

        $this->dropTable('{{%perfil}}');
    }
}
