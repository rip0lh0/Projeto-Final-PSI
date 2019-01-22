<?php namespace frontend\tests;

use backend\models\AnimalForm;

class AnimalTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;
    public $animal;
    public function testAnimalName()
    {
        $animal = new AnimalForm();
        $animal->name = 'Tobias';
        $this->assertEquals($animal->name, 'Tobias');
    }
    public function testAnimalAge()
    {
        $animal = new AnimalForm();
        $animal->age = '2';
        $this->assertEquals($animal->age, '2');
    }

    public function testAnimalNeutered()
    {
        $animal = new AnimalForm();
        $animal->neutered = '1';
        $this->assertEquals($animal->neutered, '1');
    }
    public function testAnimalGender()
    {
        $animal = new AnimalForm();
        $animal->gender = '1';
        $this->assertEquals($animal->gender, '1');
    }
    public function testAnimal()
    {
        $animal = new AnimalForm();
        $animal->name = 'Tobias';
        $animal->neutered = '1';
        $animal->gender = 'M';
        $animal->description = 'small';       
        $animal->age = '2';        
        $animal->createAnimal();
    }
}