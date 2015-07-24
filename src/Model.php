<?php

namespace Aurora\Service;

use Aurora\Helper\StatefulTrait;
use Aurora\Application;

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
      $model = Application::getNamespace($model);

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
