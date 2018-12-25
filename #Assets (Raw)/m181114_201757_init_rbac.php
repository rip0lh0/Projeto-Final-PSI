<?php

use yii\db\Migration;

/**
 * Class m181114_201753_init_rbac
 */
class m181114_201757_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $auth = Yii::$app->authManager;

        /* Animal Permissions */
        // add "createAnimal" permission
        $createAnimal = $auth->createPermission('createAnimal');
        $createAnimal->description = 'Add Animal';
        $auth->add($createAnimal);
        // add "updateAnimal" permission
        $updateAnimal = $auth->createPermission('updateAnimal');
        $updateAnimal->description = 'Update Animal';
        $auth->add($updateAnimal);
        // add "viewAnimal" permission
        $viewAnimal = $auth->createPermission('viewAnimal');
        $viewAnimal->description = 'View Animal';
        $auth->add($viewAnimal);
        /* End Animal Permissions */

        /* Medical Permissions */
        // add "addMedical" permission
        $addMedical = $auth->createPermission('addMedical');
        $addMedical->description = 'Add Medical';
        $auth->add($addMedical);
        // add "updateMedical" permission
        $updateMedical = $auth->createPermission('updateMedical');
        $updateMedical->description = 'Update Medical';
        $auth->add($updateMedical);
        // add "viewMedical" permission
        $viewMedical = $auth->createPermission('viewMedical');
        $viewMedical->description = 'View Medical';
        $auth->add($viewMedical);
        /* End Medical Permissions */

        /* Adoption Permissions*/
        // add "createAdoption" permission
        $createAdoption = $auth->createPermission('createAdoption');
        $createAdoption->description = 'Create Adoption';
        $auth->add($createAdoption);
        // add "updateAdoption" permission
        $updateAdopiton = $auth->createPermission('updateAdopiton');
        $updateAdopiton->description = 'Update Adoption';
        $auth->add($updateAdopiton);
        // add "createAdoption" permission
        $requestAdoption = $auth->createPermission('requestAdoption');
        $requestAdoption->description = 'Request Adoption';
        $auth->add($requestAdoption);
        /* End Adoption Permissions */

        /* Kennel Roles */
        $kennel = $auth->createRole('kennel');
        $auth->add($kennel);
        // Animal
        $auth->addChild($kennel, $createAnimal);
        $auth->addChild($kennel, $updateAnimal);
        $auth->addChild($kennel, $viewAnimal);
        // Medical
        $auth->addChild($kennel, $updateMedical);
        $auth->addChild($kennel, $viewMedical);
        // Adoption
        $auth->addChild($kennel, $createAdoption);
        $auth->addChild($kennel, $updateAdopiton);

        /* Adopter Roles */
        $adopter = $auth->createRole('adopter');
        $auth->add($adopter);
        // Animal
        $auth->addChild($adopter, $viewAnimal);
        // Medical
        $auth->addChild($adopter, $viewMedical);
        // Adoption
        $auth->addChild($adopter, $requestAdoption);

        $auth->assign($adopter, 2);
        $auth->assign($kennel, 1);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181112_160621_init_rbac cannot be reverted.\n";

        return false;
    }
     */
}
