<?php

use yii\db\Migration;

/**
 * Class m181129_094208_breed_coat
 */
class m181129_094208_Breed_Coat extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%breed_coat}}', [
            'id_coat' => $this->integer()->notNull(),
            'id_breed' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-breed_coat-id_coat',
            '{{%breed_coat}}',
            'id_coat'
        );

        $this->addForeignKey(
            'fk-breed_coat-id_coat',
            '{{%breed_coat}}',
            'id_coat',
            '{{%energy}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-breed_coat-id_breed',
            '{{%breed_coat}}',
            'id_breed'
        );

        $this->addForeignKey(
            'fk-breed_coat-id_breed',
            '{{%breed_coat}}',
            'id_breed',
            '{{%breed}}',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-breed_coat-id_breed',
            '{{%breed_coat}}'
        );

        $this->dropIndex(
            'idx-breed_coat-id_breed',
            '{{%breed_coat}}'
        );

        $this->dropForeignKey(
            'fk-breed_coat-id_coat',
            '{{%breed_coat}}'
        );

        $this->dropIndex(
            'idx-breed_coat-id_coat',
            '{{%breed_coat}}'
        );
        $this->dropTable('{{%breed_coat}}');
    }
}
