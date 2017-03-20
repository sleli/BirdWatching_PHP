<?php
class FieldSize 
{
  private $width;
  private $height;
  private $depth;

  public function __construct($width, $height, $depth) 
  {
    $this->width = $width;
    $this->height = $height;
    $this->depth = $depth;
  }

  public function height() 
  {
    return $this->height;
  }

  public function width() 
  {
    return $this->width;
  }

  public function depth() 
  {
    return $this->depth;
  }

  public function isWithinField($h, $x, $y) 
  {
    return $h >= 0 && $h <= $this->depth && ($x >= 0 && $x <= $this->width && y >= 0 && $y <= $this->height);
  }
}