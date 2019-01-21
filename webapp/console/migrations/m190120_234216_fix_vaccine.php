<?php

use yii\db\Migration;

/**
 * Class m190120_234216_fix_vaccine
 */
class m190120_234216_fix_vaccine extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->renameColumn("vaccine", "id_tretment", "id_treatment");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190120_234216_fix_vaccine cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190120_234216_fix_vaccine cannot be reverted.\n";

        return false;
    }
     */
}
