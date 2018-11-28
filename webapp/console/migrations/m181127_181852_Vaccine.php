<?php

use yii\db\Migration;

/**
 * Class m181127_181852_Vaccine
 */
class m181127_181852_Vaccine extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%vaccine}}', [
            'id' => $this->primaryKey(),
            'id_tretment' => $this->integer()->notNull(),
            'vaccine' => $this->string()->notNull(),
            'date' => $this->date(),
        ], $tableOptions);

        $this->createIndex(
            'idx-vaccine-id_tretment',
            '{{%vaccine}}',
            'id_tretment'
        );

        $this->addForeignKey(
            'fk-vaccine-id_tretment',
            '{{%vaccine}}',
            'id_tretment',
            '{{%treatment}}',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-vaccine-id_tretment',
            '{{%vaccine}}'
        );

        $this->dropIndex(
            'idx-vaccine-id_tretment',
            '{{%vaccine}}'
        );

        $this->dropTable('{{%vaccine}}');
    }
}
