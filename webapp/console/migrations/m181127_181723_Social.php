<?php

use yii\db\Migration;

/**
 * Class m181127_181859_Social
 */
class m181127_181723_Social extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%social}}', [
            'id' => $this->primaryKey(),
            'facebook' => $this->string(),
            'instagram' => $this->string(),
            'youtube' => $this->string(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%social}}');
    }
}
