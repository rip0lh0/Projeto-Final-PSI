<?php

use yii\db\Migration;

/**
 * Class m181105_162126_perfil
 */
class m181105_162126_perfil extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('perfil', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer()->notNull(),
            'id_tipo' => $this->integer()->notNull(),
            'nif' => $this->double()->notNull(),
            'nome' => $this->string()->notNull(),
            'morada' => $this->string(),
            'localidade' => $this->string(),
            'nacionalidade' => $this->string(),
            'contacto' => $this->string()->notNull(),
        ]);

        // Creates Index For Column `id_adotante`
        $this->createIndex(
            'idx-perfil-id_user',
            'perfil',
            'id_user'
        );
        // Add Foreign Key For Table `Adotante`
        $this->addForeignKey(
            'fk-adotar-id_user',
            'perfil',
            'id_user',
            'user',
            'id',
            'CASCADE'
        );
        // Creates Index For Column `id_adotante`
        $this->createIndex(
            'idx-adotar-id_tipo',
            'perfil',
            'id_tipo'
        );
        // Add Foreign Key For Table `Adotante`
        $this->addForeignKey(
            'fk-adotar-id_tipo',
            'perfil',
            'id_tipo',
            'tipo_perfil',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('perfil');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181105_162126_perfil cannot be reverted.\n";

        return false;
    }
     */
}
