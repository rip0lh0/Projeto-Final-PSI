<?php

use yii\db\Migration;

class m181115_201756_adocao extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%adocao}}', [
            'id' => $this->primaryKey(),
            'id_Adotante' => $this->integer()->notNull(),
            'id_canil_animal' => $this->integer()->notNull(),
            'descricao' => $this->string(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
            'state' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-adocao-id_Adotante',
            '{{%adocao}}',
            'id_Adotante'
        );

        $this->addForeignKey(
            'fk-adocao-id_Adotante',
            '{{%adocao}}',
            'id_Adotante',
            '{{%perfil}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-adocao-id_canil_animal',
            '{{%adocao}}',
            'id_canil_animal'
        );

        $this->addForeignKey(
            'fk-adocao-id_canil_animal',
            '{{%adocao}}',
            'id_canil_animal',
            '{{%canil_animal}}',
            'id',
            'CASCADE'
        );


    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-adocao-id_Adotante',
            '{{%adocao}}'
        );

        $this->dropIndex(
            'idx-adocao-id_Adotante',
            '{{%adocao}}'
        );

        $this->dropForeignKey(
            'fk-adocao-id_canil_animal',
            '{{%adocao}}'
        );

        $this->dropIndex(
            'idx-adocao-id_canil_animal',
            '{{%adocao}}'
        );
        $this->dropTable('{{%adocao}}');
    }
}
