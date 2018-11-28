<?php

use yii\db\Migration;

/**
 * Class m181127_181906_Schedule
 */
class m181127_181906_Schedule extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%schedule}}', [
            'id' => $this->primaryKey(),
            'id_kennel' => $this->integer()->notNull(),
            'day' => $this->integer()->notNull(),
            'open_time' => $this->time(),
            'close_time' => $this->time(),
        ], $tableOptions);

        $this->createIndex(
            'idx-schedule-id_kennel',
            '{{%schedule}}',
            'id_kennel'
        );

        $this->addForeignKey(
            'fk-schedule-id_kennel',
            '{{%schedule}}',
            'id_kennel',
            '{{%kennel}}',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-schedule-id_kennel',
            '{{%schedule}}'
        );

        $this->dropIndex(
            'idx-schedule-id_kennel',
            '{{%schedule}}'
        );
        $this->dropTable('{{%schedule}}');
    }
}
