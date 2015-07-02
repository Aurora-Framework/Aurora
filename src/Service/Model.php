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

namespace Aurora\Service;

use Aurora\Helper\StatefulTrait;

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

   use StatefulTrait;
   private $Connection;

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

   public function create($model, $name = null)
   {
      $name = ($name) ? $name : $model;
      $model = \Aurora\App::getNamespace($model);
      return $this->data[$name] = new $model($this->Connection);
   }

   public function createFromArray($models)
   {
      if (is_array($models)) {
         foreach ($models as $key => $value) {
            $this->create($value, $key);
         }
      }
   }
}
