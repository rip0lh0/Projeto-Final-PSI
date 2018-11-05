<?php

use yii\db\Migration;

/**
 * Class m181105_162137_tipo_perfil
 */
class m181105_162137_tipo_perfil extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tipo_perfil', [
            'id' => $this->primaryKey(),
            'descricao' => $this->string()->notNull()
        ]);


        $this->insert('tipo_perfil', [
            'descricao' => 'Canil'
        ]);
        $this->insert('tipo_perfil', [
            'descricao' => 'Adotante'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tipo_perfil');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181105_162137_tipo_perfil cannot be reverted.\n";

        return false;
    }
     */
}
