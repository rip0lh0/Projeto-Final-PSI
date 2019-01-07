<?php

use yii\db\Migration;

/**
 * Class m190107_211744_update_data
 */
class m190107_211744_update_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';

        /* Animal Table */
        $this->addColumn('animal', 'id_coat', $this->integer());
        $this->addColumn('animal', 'id_energy', $this->integer());
        $this->addColumn('animal', 'id_size', $this->integer());
        $this->addColumn('animal', 'chip', $this->string()->unique());
        $this->addColumn('animal', 'age', $this->float()->null());
        $this->addColumn('animal', 'gender', $this->integer());
        $this->addColumn('animal', 'weight', $this->integer());
        $this->addColumn('animal', 'neutered', $this->tinyInteger()->notNull());
        $this->addColumn('animal', 'created_at', $this->dateTime()->notNull());
        $this->addColumn('animal', 'updated_at', $this->dateTime()->notNull());
        $this->addColumn('animal', 'status', $this->integer()->notNull());

        /* Drop Foreign Key & Index */
        $this->dropForeignKey(
            'fk-treatment-id_animal_file',
            '{{%treatment}}'
        );

        $this->dropIndex(
            'idx-treatment-id_animal_file',
            '{{%treatment}}'
        );

        $this->dropForeignKey(
            'fk-animal_file-id_animal',
            '{{%animal_file}}'
        );

        $this->dropIndex(
            'idx-animal_file-id_animal',
            '{{%animal_file}}'
        );

        $this->dropForeignKey(
            'fk-user-id_local',
            '{{%user}}'
        );

        $this->dropIndex(
            'idx-user-id_local',
            '{{%user}}'
        );

        $this->dropForeignKey(
            'fk-kennel-id_user',
            '{{%kennel}}'
        );

        $this->dropIndex(
            'idx-kennel-id_user',
            '{{%kennel}}'
        );

        $this->dropForeignKey(
            'fk-kennel-id_contact',
            '{{%kennel}}'
        );

        $this->dropIndex(
            'idx-kennel-id_contact',
            '{{%kennel}}'
        );

        $this->dropForeignKey(
            'fk-kennel-id_social',
            '{{%kennel}}'
        );

        $this->dropIndex(
            'idx-kennel-id_social',
            '{{%kennel}}'
        );

        $this->createIndex(
            'idx-treatment-id_animal',
            '{{%treatment}}',
            'id_animal'
        );

        $this->addForeignKey(
            'fk-treatment-id_animal',
            '{{%treatment}}',
            'id_animal',
            '{{%animal}}',
            'id',
            'CASCADE'
        );

        /* Animal_Breed */
        $this->createTable('{{%animal_breed}}', [
            'id_animal' => $this->integer()->notNull(),
            'id_breed' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-animal_breed-id_animal',
            '{{%animal_breed}}',
            'id_animal'
        );

        $this->addForeignKey(
            'fk-animal_breed-id_animal',
            '{{%animal_breed}}',
            'id_animal',
            '{{%animal}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-animal_breed-id_breed',
            '{{%animal_breed}}',
            'id_breed'
        );

        $this->addForeignKey(
            'fk-animal_breed-id_breed',
            '{{%animal_breed}}',
            'id_breed',
            '{{%breed}}',
            'id',
            'CASCADE'
        );

        /* New Columns */
        $this->addColumn('treatment', 'id_animal');
        $this->addColumn('kennel', 'id_local', $this->integer()->notNull());
        $this->addColumn('kennel', 'phone', $this->string());
        $this->addColumn('kennel', 'cell_phone', $this->string());
        $this->addColumn('kennel', 'fax', $this->string());
        $this->addColumn('kennel', 'facebook', $this->string());
        $this->addColumn('kennel', 'instagram', $this->string());
        $this->addColumn('kennel', 'youtube', $this->string());

        /* Final Drops */
        $this->dropColumn('user', 'id_local');
        $this->dropColumn('kennel', 'id_contact');
        $this->dropColumn('kennel', 'id_social');
        $this->dropColumn('treatment', 'id_animal_file');
        $this->dropColumn('treatment', 'created_at');
        $this->dropColumn('treatment', 'updated_at');


        $this->dropTable('contact');
        $this->dropTable('social');
        $this->dropTable('file_breed');
        $this->dropTable('animal_file');

    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        echo "m190107_211744_update_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190107_211744_update_data cannot be reverted.\n";

        return false;
    }
     */
}
