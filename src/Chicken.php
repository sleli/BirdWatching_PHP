<?php
require_once "Bird.php";
class Chicken extends Bird 
{
	public function sing() 
	{
		console.log('Cluck');
	}

	public function setHeight($height) 
	{
		throw new Error('I can\'t fly');
	}
}