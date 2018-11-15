<?php

use yii\db\Migration;

class m181114_201755_create_table_canil_animal extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%canil_animal}}', [
            'id' => $this->primaryKey(),
            'id_Animal' => $this->integer()->notNull(),
            'id_Canil' => $this->integer()->notNull(),
            'discricao' => $this->string()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
        ], $tableOptions);

        $this->createIndex('fkIdx_150', '{{%canil_animal}}', 'id_Canil');
        $this->createIndex('fkIdx_147', '{{%canil_animal}}', 'id_Animal');
    }

    public function down()
    {
        $this->dropTable('{{%canil_animal}}');
    }
}
