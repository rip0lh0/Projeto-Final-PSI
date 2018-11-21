<?php

use yii\db\Migration;

class m181115_201754_ficha extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ficha}}', [
            'id' => $this->primaryKey(),
            'id_raca' => $this->integer()->notNull(),
            'chip' => $this->tinyInteger()->notNull(),
            'genero' => $this->char()->notNull(),
            'tamanho' => $this->float(),
            'idade' => $this->integer(),
            'castrado' => $this->string()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-ficha-id_raca',
            '{{%ficha}}',
            'id_raca'
        );

        $this->addForeignKey(
            'fk-ficha-id_raca',
            '{{%ficha}}',
            'id_raca',
            '{{%raca}}',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-ficha-id_raca',
            '{{%ficha}}'
        );

        $this->dropIndex(
            'idx-ficha-id_raca',
            '{{%ficha}}'
        );


        $this->dropTable('{{%ficha}}');
    }
}
