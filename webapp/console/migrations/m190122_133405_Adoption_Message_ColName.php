<?php

use yii\db\Migration;

/**
 * Class m190122_133405_Adoption_Message_ColName
 */
class m190122_133405_Adoption_Message_ColName extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->renameColumn("adoption", "state", "status");
        $this->renameColumn("message", "satus", "status");

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190122_133405_Adoption_Message_ColName cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190122_133405_Adoption_Message_ColName cannot be reverted.\n";

        return false;
    }
     */
}
