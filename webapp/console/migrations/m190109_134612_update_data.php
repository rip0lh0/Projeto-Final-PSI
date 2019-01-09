<?php

use yii\db\Migration;

/**
 * Class m190109_134612_update_data
 */
class m190109_134612_update_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('adopter', 'id_user', $this->integer()->notNull());
        $this->createIndex(
            'idx-adopter-id_user',
            '{{%adopter}}',
            'id_user'
        );

        $this->addForeignKey(
            'fk-adopter-id_user',
            '{{%adopter}}',
            'id_user',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        echo "m190109_134612_update_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190109_134612_update_data cannot be reverted.\n";

        return false;
    }
     */
}
