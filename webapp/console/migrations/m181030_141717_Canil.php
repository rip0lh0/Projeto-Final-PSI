<?php

use yii\db\Migration;

/**
 * Class m181030_141717_Canil
 */
class m181030_141717_Canil extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('canil', [
            'id' => $this->primaryKey(),
            'nome' => $this->string()->notNull(),
            'morada' => $this->string()->notNull(),
            'localidade' => $this->string()->notNull(),
            'contacto' => $this->string()->notNull(),
            'email' => $this->string()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drops Table 'canil'
        $this->dropTable('canil');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181030_141717_Canil cannot be reverted.\n";

        return false;
    }
     */
}
