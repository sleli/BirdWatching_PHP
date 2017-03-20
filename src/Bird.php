<?php
class Bird 
{
  private $height;
  private $location;

  public function setHeight($height) 
  {
    $this->height = $height;
  }

  public function getHeight() 
  {
    return $this->height ;
  }

  public function setLocation($location) 
  {
    $this->location = $location;
  }

  public function getLocation() 
  {
    return $this->location;
  }
}