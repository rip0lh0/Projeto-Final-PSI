<?php

use yii\db\Migration;

class m181114_201755_create_table_ficha_medica extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ficha_medica}}', [
            'id' => $this->primaryKey(),
            'id_animal' => $this->integer()->notNull(),
            'chip' => $this->tinyInteger()->notNull(),
            'genero' => $this->char()->notNull(),
            'tamanho' => $this->float(),
            'idate' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createIndex(
            'idx-ficha_medica-id_Animal',
            '{{%ficha_medica}}',
            'id_Animal'
        );

        $this->addForeignKey(
            'fk-ficha_medica-id_Animal',
            '{{%ficha_medica}}',
            'id_Animal',
            '{{%animal}}',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-ficha_medica-id_Animal',
            '{{%ficha_medica}}'
        );

        $this->dropIndex(
            'idx-ficha_medica-id_Animal',
            '{{%ficha_medica}}'
        );


        $this->dropTable('{{%ficha_medica}}');
    }
}
