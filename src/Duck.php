<?php
require_once "Bird.php";
class Duck extends Bird {
	public function sing() {
		console.log('Squawk');
	}
}