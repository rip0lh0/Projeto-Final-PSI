<?php

use yii\db\Migration;

/**
 * Class m181120_214849_type_animal
 */
class m181115_201753_type_animal extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%type_animal}}', [
            'id' => $this->primaryKey(),
            'tipo' => $this->string()->notNull(),
        ], $tableOptions);

        $this->insert('{{%type_animal}}', ['tipo' => 'Cão']);
        $this->insert('{{%type_animal}}', ['tipo' => 'Gato']);

    }

    public function down()
    {
        echo "m181120_214849_type_animal cannot be reverted.\n";

        return false;
    }

}
