<?php

use yii\db\Migration;

/**
 * Class m190122_145634_Adoption_ColName
 */
class m190122_145634_Adoption_ColName extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->renameColumn('adoption', 'id_animal', 'id_kennelAnimal');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190122_145634_Adoption_ColName cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190122_145634_Adoption_ColName cannot be reverted.\n";

        return false;
    }
     */
}
