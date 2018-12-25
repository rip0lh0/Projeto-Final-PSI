<?php

use yii\db\Migration;

class m181115_201753_raca extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%raca}}', [
            'id' => $this->primaryKey(),
            'id_parent' => $this->integer(),
            'nome' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-raca-id_parent',
            '{{%raca}}',
            'id_parent'
        );

        $this->addForeignKey(
            'fk-raca-id_parent',
            '{{%raca}}',
            'id_parent',
            '{{%raca}}',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-raca-id_parent',
            '{{%raca}}'
        );

        $this->dropIndex(
            'idx-raca-id_parent',
            '{{%raca}}'
        );

        $this->dropTable('{{%raca}}');
    }
}
