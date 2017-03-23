<?php
require_once "Location.php";
require_once "Chicken.php";

class GameField 
{
	public function __construct($width, $height, $depth, $fieldSize) 
	{
		$this->width = $width;
		$this->height = $height;
		$this->depth = $depth;
		$this->fieldSize = $fieldSize;
		$this->birds = array();
		$this->gameStarted = false;
	}

	public function addBird($bird) 
	{
		array_push($this->birds, $bird);
		//echo 'Birds: ' . intval($this->birds->length); 
	}

	//Start the game
	public function startGame($pm) 
	{
		try 
		{
			$this->placeBirds($pm);
			$this->gameStarted = count($this->birds) > 0 && $this->isGameFieldValid();
		} catch (Exception $err)  
		{
			$this->gameStarted = false;
		}
		return $this->gameStarted;
	}

	//Shot to a bird
	public function shot($x, $y, $h) 
	{
		$hit = false;
		if ($this->gameStarted) 
		{
			foreach( $this->birds as $bird)
			{
				$height = $bird->getHeight();
				$location = $bird->getLocation();
				$hit = $location->x == $x && $location->y == $y && $height == $h;
				if ($hit) {
					$bird->sing();
					break;
				}
			}
		}
		return $hit;
	}

	//Place the birds on the fields
	public function placeBirds($type) {
		//Random Distribution
		if ($type == 'RANDOM') 
		{
			foreach( $this->birds as $bird) 
			{
				$location = new Location($this->getRandomInt($this->width), $this->getRandomInt($this->height));
				$bird->setLocation($location);
				if (!($bird instanceof Chicken)) 
				{
					$bird->setHeight($this->getRandomInt($this->depth));
				}
			}
		}
		//Custom Distribution
		else if ($type == 'CUSTOM') {

		}
	}

	//Check if the GameField is Valid
	public function isGameFieldValid() 
	{
		$isValid = true;
		foreach( $this->birds as $bird)  
		{
			$h =$bird->getHeight();
			$location = $bird->getLocation();
			$x = $location->x;
			$y = $location->y;
			$isValid =  $this->fieldSize->isWithinField($h, $x, $y);
			if (!$isValid)
				break;
		}
		return $isValid;
		
	}

	//Generate random int between 0 and max
	public function getRandomInt($max) {
		return rand(0,$max);
	}
}