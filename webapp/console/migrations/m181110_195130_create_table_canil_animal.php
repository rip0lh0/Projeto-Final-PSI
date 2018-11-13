<?php

use yii\db\Migration;

class m181110_195130_create_table_canil_animal extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%canil_animal}}', [
            'id' => $this->primaryKey(),
            'discricao' => $this->string()->notNull(),
            'data_entrada' => $this->dateTime()->notNull(),
            'id_Animal' => $this->integer()->notNull(),
            'id_Canil' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('fkIdx_150', '{{%canil_animal}}', 'id_Canil');
        $this->createIndex('fkIdx_147', '{{%canil_animal}}', 'id_Animal');
    }

    public function down()
    {
        $this->dropTable('{{%canil_animal}}');
    }
}
