<?php
require_once('./src/GameField.php');
require_once('./src/FieldSize.php');
require_once('./src/Chicken.php');
require_once('./src/Duck.php');
require_once('./src/Location.php');

use PHPUnit\Framework\TestCase;

final class BirdWatchingTest extends TestCase
{

    private $field;

    protected function setUp()
    {
        $this->field = new GameField(10,5,3, new FieldSize(10,5,3));
    }

    public function testRandomPlacingShouldStartGame()
    {
        $this->field->addBird(new Chicken());
        $this->field->addBird(new Duck());
        $this->assertEquals($this->field->startGame("RANDOM"), true);
    }

    public function testCustomPlacingShouldStartGameWithValidBirdsPlacing()
    {
        $chicken = new Chicken();
        $chicken->setLocation(new Location(0,0));

        $duck = new Duck();
        $duck->setLocation(new Location(10,5));
        $duck->setHeight(3);

        $this->field->addBird($chicken);
        $this->field->addBird($duck);
        $this->assertEquals($this->field->startGame("CUSTOM"), true);
    }

    public function testCustomPlacingShouldNotStartGameWithInvalidBirdsPlacing()
    {                  
        $chicken = new Chicken();
        $chicken->setLocation(new Location(11,0));

        $duck = new Duck();
        $duck->setLocation(new Location(10,5));
        $duck->setHeight(4);

        $this->field->addBird($chicken);
        $this->field->addBird($duck);
        $this->assertEquals($this->field->startGame("CUSTOM"), false);
    }

    public function testRightShotShouldFailIfGameIsNotStarted()
    {                  
        $duck = new Duck();
        $duck->setLocation(new Location(10,5));
        $duck->setHeight(3);
        
        $this->field->addBird($duck);
        $this->assertEquals($this->field->shot(10, 5, 3), false);
    }

    public function testRightShotShouldHitABird()
    {                  
        $duck = new Duck();
        $duck->setLocation(new Location(10,5));
        $duck->setHeight(3);
        
        $this->field->addBird($duck);
        $this->field->startGame("CUSTOM");
        $this->assertEquals($this->field->shot(10, 5, 3), true);
    }

    public function testWrongShotShouldMissABird()
    {                  
        $duck = new Duck();
        $duck->setLocation(new Location(10,5));
        $duck->setHeight(3);
        
        $this->field->startGame("CUSTOM");
        $this->field->addBird($duck);
        $this->assertEquals($this->field->shot(9, 5, 3), false);
    }


}