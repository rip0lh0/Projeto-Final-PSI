<?php

use yii\db\Migration;

/**
 * Class m181030_141710_Adoptar
 */
class m181030_141710_adoptar extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('adotar', [
            'id' => $this->primaryKey(),
            'id_adotante' => $this->integer()->notNull(),
            'id_animal' => $this->integer()->notNull(),
            'data_adocao' => $this->datetime()->notNull(),
        ]);

        // Creates Index For Column `id_adotante`
        $this->createIndex(
            'idx-adotar-id_adotante',
            'adotar',
            'id_adotante'
        );
        // Add Foreign Key For Table `Adotante`
        $this->addForeignKey(
            'fk-adotar-id_animal',
            'adotar',
            'id_adotante',
            'adotante',
            'id',
            'CASCADE'
        );
        // Creates Index For Column `id_raca`
        $this->createIndex(
            'idx-adotar-id_animal',
            'adotar',
            'id_adotante'
        );
        // Add Foreign Key For Table `raca`
        $this->addForeignKey(
            'fk-adotar-id_animal',
            'adotar',
            'id_animal',
            'animal',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('adotar');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181030_141710_Adoptar cannot be reverted.\n";

        return false;
    }
     */
}
