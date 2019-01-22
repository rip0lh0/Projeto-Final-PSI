<?php namespace frontend\tests;

class AnimalTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;
    public $animal;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testAnimalName()
    {
        $animal = new AnimalForm();
        $animal->name = 'Tobias';
        $this->assertEquals($animal->name, 'animalia');
    }
    public function testAnimal()
    {
        $animal = new AnimalForm();
        $animal->name = 'Tobias';
        $animal->description = 'asvdfjsgag';
        $this->assertEquals($animal->name, 'animalia');
    }
}