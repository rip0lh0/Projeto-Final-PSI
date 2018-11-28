<?php

use yii\db\Migration;

/**
 * Class m181127_181927_Contact
 */
class m181127_181722_Contact extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%contact}}', [
            'id' => $this->primaryKey(),
            'phone' => $this->double()->null(),
            'cellphone' => $this->double()->null(),
            'fax' => $this->double()->null(),
            'updated_at' => $this->dateTime()
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%contact}}');
    }
}
