<?php

use yii\db\Migration;

/**
 * Class m181129_094147_Size
 */
class m181129_094147_Size extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%size}}', [
            'id' => $this->primaryKey(),
            'size' => $this->string()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%size}}');
    }
}
