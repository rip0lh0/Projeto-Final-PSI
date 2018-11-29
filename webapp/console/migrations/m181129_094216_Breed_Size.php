<?php

use yii\db\Migration;

/**
 * Class m181129_094216_breed_size
 */
class m181129_094216_Breed_Size extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%breed_size}}', [
            'id_size' => $this->integer()->notNull(),
            'id_breed' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-breed_size-id_size',
            '{{%breed_size}}',
            'id_size'
        );

        $this->addForeignKey(
            'fk-breed_size-id_size',
            '{{%breed_size}}',
            'id_size',
            '{{%energy}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-breed_size-id_breed',
            '{{%breed_size}}',
            'id_breed'
        );

        $this->addForeignKey(
            'fk-breed_size-id_breed',
            '{{%breed_size}}',
            'id_breed',
            '{{%breed}}',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-breed_size-id_breed',
            '{{%breed_size}}'
        );

        $this->dropIndex(
            'idx-breed_size-id_breed',
            '{{%breed_size}}'
        );

        $this->dropForeignKey(
            'fk-breed_size-id_size',
            '{{%breed_size}}'
        );

        $this->dropIndex(
            'idx-breed_size-id_size',
            '{{%breed_size}}'
        );

        $this->dropTable('{{%breed_size}}');
    }
}
