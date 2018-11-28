<?php

use yii\db\Migration;

/**
 * Class m181127_181831_Kennel
 */
class m181127_181831_Kennel extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%kennel}}', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer()->notNull(),
            'id_contact' => $this->integer()->notNull(),
            'id_social' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'nif' => $this->double()->notNull(),
            'address' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-kennel-id_user',
            '{{%kennel}}',
            'id_user'
        );

        $this->addForeignKey(
            'fk-kennel-id_user',
            '{{%kennel}}',
            'id_user',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-kennel-id_contact',
            '{{%kennel}}',
            'id_contact'
        );

        $this->addForeignKey(
            'fk-kennel-id_contact',
            '{{%kennel}}',
            'id_contact',
            '{{%contact}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-kennel-id_social',
            '{{%kennel}}',
            'id_social'
        );

        $this->addForeignKey(
            'fk-kennel-id_social',
            '{{%kennel}}',
            'id_social',
            '{{%social}}',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {

        $this->dropForeignKey(
            'fk-kennel-id_user',
            '{{%kennel}}'
        );

        $this->dropIndex(
            'idx-kennel-id_user',
            '{{%kennel}}'
        );

        $this->dropForeignKey(
            'fk-kennel-id_contact',
            '{{%kennel}}'
        );

        $this->dropIndex(
            'idx-kennel-id_contact',
            '{{%kennel}}'
        );

        $this->dropForeignKey(
            'fk-kennel-id_social',
            '{{%kennel}}'
        );

        $this->dropIndex(
            'idx-kennel-id_social',
            '{{%kennel}}'
        );

        $this->dropTable('{{%kennel}}');
    }
}
