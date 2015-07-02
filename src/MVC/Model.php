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
 * Model
 *
 * @category   Common
 * @package    Aurora
 * @author     VeeeneX <veeenex@gmail.com>
 * @copyright  2015 Caroon
 * @license    MIT
 * @version    0.1.3
 *
 */
class Model
{

   protected $Connection;

   public function __construct($Connection)
   {
      $this->Connection = $Connection;
   }

   public function setConnection($Connection)
   {
      $this->Connection = $Connection;
   }

   public function getConnection()
   {
      return $this->Connection;
   }

}
