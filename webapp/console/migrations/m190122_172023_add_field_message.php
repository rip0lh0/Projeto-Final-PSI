<?php

use yii\db\Migration;

/**
 * Class m190122_172023_add_field_message
 */
class m190122_172023_add_field_message extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('message', 'id_user', $this->integer()->notNull());

        $this->createIndex(
            'idx-message-id_user',
            '{{%message}}',
            'id_user'
        );

        $this->addForeignKey(
            'fk-message-id_user',
            '{{%message}}',
            'id_user',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190122_172023_add_field_message cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190122_172023_add_field_message cannot be reverted.\n";

        return false;
    }
     */
}
