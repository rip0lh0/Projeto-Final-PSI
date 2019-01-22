<?php namespace frontend\tests;
use frontend\models\MessageForm;
class AdoptionTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;
    public $adoption;


    // tests
    public function testAdopt()
    {
        $adoption = new MessageForm();
        $adoption->id_adopter=1;
        $adoption->id_animal=1;
        $adoption->id_adoption=1;
        $adoption->message="Adoro este animal, gostaria de ter-lo";
        $adoption->saveMessage();
    }
}