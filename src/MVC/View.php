<?php

/**
 * Aurora - Framework
 *
 * Aurora is fast, simple, extensible Framework
 *
 *
 * @category   Framework
 * @package    Aurora
 * @author     VeeeneX <veeenex@gmail.com>
 * @copyright  2015 Caroon
 * @license    MIT
 * @version    0.1.3
 * @link       http://caroon.com/Aurora
 *
 */

namespace Aurora\MVC;

/**
 * View
 *
 * @category   Common
 * @package    Aurora
 * @author     VeeeneX <veeenex@gmail.com>
 * @copyright  2015 Caroon
 * @license    MIT
 * @version    0.1.3
 *
 */

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
