<?php

use yii\db\Migration;

class m181114_201754_create_table_adocao extends Migration
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
            'data_adocao' => $this->dateTime()->notNull(),
            'descricao' => $this->string(),
            'state' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('fkIdx_171', '{{%adocao}}', 'id_canil_animal');
        $this->createIndex('fkIdx_162', '{{%adocao}}', 'id_Adotante');
    }

    public function down()
    {
        $this->dropTable('{{%adocao}}');
    }
}
