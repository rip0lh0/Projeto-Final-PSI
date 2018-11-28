<?php

use yii\db\Migration;

/**
 * Class m181127_181721_Local
 */
class m181127_181721_Local extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%local}}', [
            'id' => $this->primaryKey(),
            'id_parent' => $this->integer(),
            'name' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-local-id_parent',
            '{{%local}}',
            'id_parent'
        );

        $this->addForeignKey(
            'fk-local-id_parent',
            '{{%local}}',
            'id_parent',
            '{{%local}}',
            'id',
            'CASCADE'
        );

    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-local-id_parent',
            '{{%local}}'
        );

        $this->dropIndex(
            'idx-local-id_parent',
            '{{%local}}'
        );

        $this->dropTable('{{%local}}');
    }
}
