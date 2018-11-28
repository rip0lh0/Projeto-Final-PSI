<?php

use yii\db\Migration;

/**
 * Class m181127_181841_Adopter
 */
class m181127_181841_Adopter extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%adopter}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'cellphone' => $this->double(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%adopter}}');
    }
}
