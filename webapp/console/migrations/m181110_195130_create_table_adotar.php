<?php

use yii\db\Migration;

class m181110_195130_create_table_adotar extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%adotar}}', [
            'id' => $this->primaryKey(),
            'id_Adotante' => $this->integer()->notNull(),
            'id_canil_animal' => $this->integer()->notNull(),
            'data_adocao' => $this->dateTime()->notNull(),
            'descricao' => $this->string()->notNull(),
            'state' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('fkIdx_171', '{{%adotar}}', 'id_canil_animal');
        $this->createIndex('fkIdx_162', '{{%adotar}}', 'id_Adotante');
    }

    public function down()
    {
        $this->dropTable('{{%adotar}}');
    }
}
