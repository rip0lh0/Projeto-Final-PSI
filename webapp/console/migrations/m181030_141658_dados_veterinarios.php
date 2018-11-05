<?php

use yii\db\Migration;

/**
 * Class m181030_141658_DadosVeterinarios
 */
class m181030_141658_dados_veterinarios extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('dados_veterinarios', [
            'id' => $this->primaryKey(),
            'vacinacao' => $this->string()->notNull(),
            'doencas' => $this->string()->notNull(),
            'chip' => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('dados_veterinarios');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181030_141658_DadosVeterinarios cannot be reverted.\n";

        return false;
    }
     */
}
