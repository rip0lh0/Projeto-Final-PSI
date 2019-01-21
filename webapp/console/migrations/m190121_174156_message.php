<?php

use yii\db\Migration;

/**
 * Class m190121_174156_create_message
 */
class m190121_174156_message extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('message', [
            'id' => $this->primaryKey(),
            'id_parent' => $this->integer(),
            'id_adoption' => $this->integer(),
            'message' => $this->string()->notNull(),
            'satus' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-message-id_parent',
            '{{%message}}',
            'id_parent'
        );

        $this->addForeignKey(
            'fk-message-id_parent',
            '{{%message}}',
            'id_parent',
            '{{%message}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-message-id_adoption',
            '{{%message}}',
            'id_adoption'
        );

        $this->addForeignKey(
            'fk-message-id_adoption',
            '{{%message}}',
            'id_adoption',
            '{{%adoption}}',
            'id',
            'CASCADE'
        );

        $this->addColumn('schedule', 'lunch_open', $this->time());
        $this->addColumn('schedule', 'lunch_close', $this->time());

    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        echo "m190121_174156_create_message cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190121_174156_create_message cannot be reverted.\n";

        return false;
    }
     */
}
