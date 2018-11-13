<?php

use yii\db\Migration;

class m181110_195130_create_table_raca extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%raca}}', [
            'id' => $this->primaryKey(),
            'descricao' => $this->string()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%raca}}');
    }
}
