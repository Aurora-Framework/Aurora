<?php

namespace Aurora\MVC;

class View
{
   protected $data = [];

   private $Engine;

   public function __construct($Engine)
   {
      $this->Engine = $Engine;
   }

   public function __get($key)
	{
		return $this->data[$key];
	}

	public function __set($key, $value)
	{
      $this->data[$key] = $value;
	}

	public function __isset($key)
	{
		return isset($this->data[$key]);
	}

	public function __unset($key)
	{
		unset($this->data[$key]);
	}

   public function render($template, $data = [])
   {
      $this->data = ($data + $this->data);
      echo $this->Engine->render($template, $this->data);
   }

   public function setEngine($Engine)
   {
      $this->Engine = $Engine;
   }
}
