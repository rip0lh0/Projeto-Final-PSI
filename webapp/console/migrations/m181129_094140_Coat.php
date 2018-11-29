<?php

use yii\db\Migration;

/**
 * Class m181129_094140_Coat
 */
class m181129_094140_Coat extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%coat}}', [
            'id' => $this->primaryKey(),
            'coat_size' => $this->string()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%energy}}');
    }
}
