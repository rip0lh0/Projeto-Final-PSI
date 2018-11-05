<?php

use yii\db\Migration;

/**
 * Class m181030_141615_Animal
 * `Id`      INT NOT NULL ,
 * `Nome`    VARCHAR(45) NOT NULL ,
 * `Raca`    VARCHAR(45) NOT NULL ,
 * `Genero`  CHAR NOT NULL ,
 * `Tamanho` FLOAT NOT NULL ,
 * `Idade`   INT NOT NULL ,
 */
class m181030_141615_animal extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('animal', [
            'id' => $this->primaryKey(),
            'id_raca' => $this->integer()->notNull(),
            'id_dados_veterinarios' => $this->integer()->notNull(),
            'id_canil' => $this->integer(),
            'nome' => $this->string()->notNull(),
            'genero' => $this->string(),
            'tamanho' => $this->float(),
            'idade' => $this->integer()
        ]);

        // Creates Index For Column `id_raca`
        $this->createIndex(
            'idx-raca-id_raca',
            'animal',
            'id_raca'
        );
        // Add Foreign Key For Table `raca`
        $this->addForeignKey(
            'fk-raca-id_raca',
            'animal',
            'id_raca',
            'raca',
            'id',
            'CASCADE'
        );
        // Creates Index For Column 'id_dados_veterinarios'
        $this->createIndex(
            'idx-raca-id_dados_veterinarios',
            'animal',
            'id_dados_veterinarios'
        );
        // Add Foreign Key For Table `dados_veterinarios`
        $this->addForeignKey(
            'fk-raca-id_dados_veterinarios',
            'animal',
            'id_dados_veterinarios',
            'dados_veterianrios',
            'id',
            'CASCADE'
        );
        // Creates Index For Column 'id_canil'
        $this->createIndex(
            'idx-raca-id_canil',
            'animal',
            'id_canil'
        );
        // Add Foreign Key For Table `canil`
        $this->addForeignKey(
            'fk-raca-id_canil',
            'animal',
            'id_canil',
            'canil',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drops Foreign Key For Table `animal`
        $this->dropForeignKey(
            'fk-raca-id_raca',
            'animal'
        );

        // Drops Index For Column `id_animal`
        $this->dropIndex(
            'idx-raca-id_raca',
            'animal'
        );

        // Drops Table 'raca'
        $this->dropTable('animal');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181030_141615_Animal cannot be reverted.\n";

        return false;
    }
     */
}
