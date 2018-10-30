<?php

use yii\db\Migration;

/**
 * Class m181030_141602_Raca
 * 
 * `Id`    NOT NULL ,
 * `Ra�a` VARCHAR(45) NOT NULL ,
 * `Desc` VARCHAR(45) NOT NULL ,
 *
 * PRIMARY KEY (`Id`, `Id_1`),
 * KEY `fkIdx_64` (`Id_1`),
 * CONSTRAINT `FK_64` FOREIGN KEY `fkIdx_64` (`Id_1`) REFERENCES `Animal` (`Id`)
 * 
 */
class m181030_141602_Raca extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('raca', [
            'id' => $this->primaryKey(),
            'raca' => $this->string(),
            'descricao' => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drops Table 'raca'
        $this->dropTable('raca');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181030_141602_Raca cannot be reverted.\n";

        return false;
    }
     */
}
