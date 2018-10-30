<?php

use yii\db\Migration;

/**
 * Class m181030_141629_Adotante
 */
class m181030_141629_Adotante extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('adotante', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer()->notNull(),
            'nif' => $this->integer()->notNull(),
            'nome' => $this->string()->notNull(),
            'morada' => $this->string()->notNull(),
            'localidade' => $this->string(),
            'nacionalidade' => $this->string(),
            'contacto' => $this->double(),
        ]);

        // Creates Index For Column `id_raca`
        $this->createIndex(
            'idx-adotante-id_user',
            'adotante',
            'id_user'
        );
        // Add Foreign Key For Table `raca`
        $this->addForeignKey(
            'fk-adotante-id_user',
            'adotante',
            'id_user',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181030_141629_Adotante cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181030_141629_Adotante cannot be reverted.\n";

        return false;
    }
     */
}
