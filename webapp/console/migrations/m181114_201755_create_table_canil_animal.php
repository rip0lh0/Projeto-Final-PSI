<?php

use yii\db\Migration;

class m181114_201755_create_table_canil_animal extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%canil_animal}}', [
            'id' => $this->primaryKey(),
            'id_Animal' => $this->integer()->notNull(),
            'id_Canil' => $this->integer()->notNull(),
            'discricao' => $this->string()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-canil_animal-id_Animal',
            '{{%canil_animal}}',
            'id_Animal'
        );

        $this->addForeignKey(
            'fk-canil_animal-id_Animal',
            '{{%canil_animal}}',
            'id_Animal',
            '{{%animal}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-canil_animal-id_Canil',
            '{{%canil_animal}}',
            'id_Canil'
        );

        $this->addForeignKey(
            'fk-canil_animal-id_Canil',
            '{{%canil_animal}}',
            'id_Canil',
            '{{%perfil}}',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-canil_animal-id_Animal',
            '{{%canil_animal}}'
        );

        $this->dropIndex(
            'idx-canil_animal-id_Animal',
            '{{%canil_animal}}'
        );

        $this->dropForeignKey(
            'fk-canil_animal-id_Canil',
            '{{%canil_animal}}'
        );

        $this->dropIndex(
            'idx-canil_animal-id_Canil',
            '{{%canil_animal}}'
        );


        $this->dropTable('{{%canil_animal}}');
    }
}
