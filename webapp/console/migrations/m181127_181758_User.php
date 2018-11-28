<?php

use yii\db\Migration;

/**
 * Class m181127_181758_User
 */
class m181127_181758_User extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'id_local' => $this->integer()->notNull(),
            'username' => $this->string()->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string(),
            'email' => $this->string()->notNull(),
            'auth_key' => $this->string()->notNull(),
            'status' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-user-id_local',
            '{{%user}}',
            'id_local'
        );

        $this->addForeignKey(
            'fk-user-id_local',
            '{{%user}}',
            'id_local',
            '{{%local}}',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-user-id_local',
            '{{%user}}'
        );

        $this->dropIndex(
            'idx-user-id_local',
            '{{%user}}'
        );

        $this->dropTable('{{%user}}');
    }
}
