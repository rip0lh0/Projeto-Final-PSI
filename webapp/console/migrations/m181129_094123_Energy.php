<?php

use yii\db\Migration;

/**
 * Class m181129_094123_Energy
 */
class m181129_094123_Energy extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%energy}}', [
            'id' => $this->primaryKey(),
            'energy' => $this->string()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%energy}}');
    }
}
