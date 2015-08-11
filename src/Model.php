<?php

namespace Aurora;

use Aurora\Helper\ObjectTrait;
use Aurora\Application;

class Model
{
   use ObjectTrait;
   private $Connection;

   public function __construct($Connection = null)
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

      return $this->data[$name] = new $model($this->Connection);
   }

   public function createFromList($models)
   {
      $models = (array) $models;
      foreach ($models as $key => $value) {
         $this->create($value, $key);
      }
   }
}
